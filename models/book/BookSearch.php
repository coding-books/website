<?php

namespace app\models\book;

use app\models\Books;
use app\models\BooksTags;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * BooksSearch represents the model behind the search form of `app\models\Books`.
 */
class BookSearch extends Model
{

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @param string $searchQuery
     *
     * @return ActiveDataProvider
     */
    public function search(string $searchQuery)
    {
        $searchResults = [];

        $books = Books::find();
        $books->where(['like', 'title', $searchQuery]);
        $books->orWhere(['like', 'description', $searchQuery]);
        $books->andWhere(['published' => 1]);

        $searchedBooks = $books->all();

        if (!empty($searchedBooks)) {
            $searchResults = $searchedBooks;
        }

        $tags = BooksTags::find();
        $tags->where(['like', 'tag', $searchQuery]);
        $booksTags = $tags->all();

        if (!empty($booksTags) && is_array($booksTags)) {
            $searchedBooksByTags = [];

            foreach ($booksTags as $tag) {
                $booksTagRef = $tag->booksTagsRefs;

                if (isset($booksTagRef) && !empty($booksTagRef)) {
                    $ids = [];

                    foreach ($booksTagRef as $bookTagRef) {
                        $ids[] = $bookTagRef->book_id;
                    }

                    $booksByTag = Books::find()->where(['in', 'id', implode(',', $ids)])->all();

                    $searchedBooksByTags = array_merge($searchedBooksByTags, $booksByTag);
                }
            }

            $searchResults = array_merge($searchResults, $searchedBooksByTags);
        }

        return $searchResults;
    }
}