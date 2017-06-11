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
        $foundResults = [];

        $searchedBooks = $this->searchBook($searchQuery);

        $searchedBooksByTag = $this->searchByTags($searchQuery);

        $foundResults = array_merge($foundResults, $searchedBooks, $searchedBooksByTag);

        return $this->generateResults($foundResults);
    }

    /**
     * @param string $searchQuery
     *
     * @return array
     */
    public function searchBook (string $searchQuery) : array {
        $books = Books::find();
        $books->where(['like', 'title', $searchQuery]);
        $books->orWhere(['like', 'description', $searchQuery]);
        $books->andWhere(['published' => 1]);

        return $books->all();
    }

    /**
     * @param string $searchQuery
     *
     * @return array
     */
    public function searchByTags (string $searchQuery) : array {
        $searchedBooksByTags = [];

        $tags = BooksTags::find();
        $tags->where(['like', 'tag', $searchQuery]);
        $booksTags = $tags->all();

        if (!empty($booksTags) && is_array($booksTags)) {

            foreach ($booksTags as $tag) {
                $booksTagRef = $tag->booksTagsRefs;

                if (isset($booksTagRef) && !empty($booksTagRef)) {
                    $ids = [];

                    foreach ($booksTagRef as $bookTagRef) {
                        $ids[] = $bookTagRef->book_id;
                    }

                    $booksByTag = Books::find()->where(['id' => $ids])->andWhere(['published' => 1])->all();

                    $searchedBooksByTags = array_merge($searchedBooksByTags, $booksByTag);
                }
            }
        }

        return $searchedBooksByTags;
    }

    public function generateResults (array $foundedBooks) {
        $newFoundedBooks = [];

        if (!empty($foundedBooks)) {
            $countBooksById = [];

            foreach ($foundedBooks as $book) {
                $countBooksById[$book->id]++;
            }

            arsort($countBooksById);

            foreach ($countBooksById as $bookId => $count) {
                foreach ($foundedBooks as $book) {
                    if ($bookId == $book->id) {
                        $newFoundedBooks[] = $book;
                        break;
                    }
                }
            }
        }

        return $newFoundedBooks;
    }
}