<?php

use PHPUnit\Framework\TestCase;

// Simulacija funkcije koja se nalazi u nav.inc.php
function redirect($url)
{
    // Simulacija preusmeravanja na drugu stranicu
}

// Simulacija funkcije koja se nalazi u news.php
function likeArticle($mysqli, $article_id)
{
    // Simulacija upita za lajkovanje članka
    $query = "UPDATE article SET likes = likes + 1 WHERE article_id = $article_id";
    $result = $mysqli->query($query); // Promenjeno da koristi $mysqli objekat
    return $result !== false; // Vraćamo true ako je upit uspešno izvršen, u suprotnom false
}

function dislikeArticle($mysqli, $article_id)
{
    // Simulacija upita za dislajkovanje članka
    $query = "UPDATE article SET dislikes = dislikes + 1 WHERE article_id = $article_id";
    $result = $mysqli->query($query); // Promenjeno da koristi $mysqli objekat
    return $result !== false; // Vraćamo true ako je upit uspešno izvršen, u suprotnom false
}

function likeComment($mysqli, $comment_id)
{
    // Simulacija upita za lajkovanje komentara
    $query = "UPDATE comments SET likes = likes + 1 WHERE comment_id = $comment_id";
    $result = $mysqli->query($query); // Promenjeno da koristi $mysqli objekat
    return $result !== false; // Vraćamo true ako je upit uspešno izvršen, u suprotnom false
}

function dislikeComment($mysqli, $comment_id)
{
    // Simulacija upita za dislajkovanje komentara
    $query = "UPDATE comments SET dislikes = dislikes + 1 WHERE comment_id = $comment_id";
    $result = $mysqli->query($query); // Promenjeno da koristi $mysqli objekat
    return $result !== false; // Vraćamo true ako je upit uspešno izvršen, u suprotnom false
}

// Simulacija funkcije koja se nalazi u comment.inc.php
function addComment($mysqli, $article_id, $user_name, $comment_text)
{
    // Simulacija upita za dodavanje komentara
    $query = "INSERT INTO comments (article_id, user_name, comment_text) VALUES ($article_id, '$user_name', '$comment_text')";
    $result = $mysqli->query($query); // Promenjeno da koristi $mysqli objekat
    return $result !== false; // Vraćamo true ako je upit uspešno izvršen, u suprotnom false
}

class NewsTest extends TestCase
{
    public function testArticleLikes()
    {
        // Kreiranje mock objekta za mysqli
        $mysqliMock = $this->getMockBuilder(stdClass::class)
                           ->setMethods(['query'])
                           ->getMock();

        // Očekivano ponašanje: funkcija query će biti pozvana tačno jednom sa odgovarajućim SQL upitom
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->with($this->equalTo("UPDATE article SET likes = likes + 1 WHERE article_id = 123"))
                   ->willReturn(true); // Simulacija uspešnog izvršavanja upita

        // Poziv funkcije za lajkovanje članka
        $result = likeArticle($mysqliMock, 123);

        // Provera da li je rezultat lajkovanja tačan
        $this->assertTrue($result);
    }

    public function testArticleDislikes()
    {
        // Kreiranje mock objekta za mysqli
        $mysqliMock = $this->getMockBuilder(stdClass::class)
                           ->setMethods(['query'])
                           ->getMock();

        // Očekivano ponašanje: funkcija query će biti pozvana tačno jednom sa odgovarajućim SQL upitom
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->with($this->equalTo("UPDATE article SET dislikes = dislikes + 1 WHERE article_id = 123"))
                   ->willReturn(true); // Simulacija uspešnog izvršavanja upita

        // Poziv funkcije za dislajkovanje članka
        $result = dislikeArticle($mysqliMock, 123);

        // Provera da li je rezultat dislajkovanja tačan
        $this->assertTrue($result);
    }

    public function testLikeComment()
    {
        // Kreiranje mock objekta za mysqli
        $mysqliMock = $this->getMockBuilder(stdClass::class)
                           ->setMethods(['query'])
                           ->getMock();

        // Očekivano ponašanje: funkcija query će biti pozvana tačno jednom sa odgovarajućim SQL upitom
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->with($this->equalTo("UPDATE comments SET likes = likes + 1 WHERE comment_id = 123"))
                   ->willReturn(true); // Simulacija uspešnog izvršavanja upita

        // Poziv funkcije za lajkovanje komentara
        $result = likeComment($mysqliMock, 123);

        // Provera da li je rezultat lajkovanja komentara tačan
        $this->assertTrue($result);
    }

    public function testDislikeComment()
    {
        // Kreiranje mock objekta za mysqli
        $mysqliMock = $this->getMockBuilder(stdClass::class)
                           ->setMethods(['query'])
                           ->getMock();

        // Očekivano ponašanje: funkcija query će biti pozvana tačno jednom sa odgovarajućim SQL upitom
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->with($this->equalTo("UPDATE comments SET dislikes = dislikes + 1 WHERE comment_id = 123"))
                   ->willReturn(true); // Simulacija uspešnog izvršavanja upita

        // Poziv funkcije za dislajkovanje komentara
        $result = dislikeComment($mysqliMock, 123);

        // Provera da li je rezultat dislajkovanja komentara tačan
        $this->assertTrue($result);
    }

    public function testAddComment()
    {
        // Kreiranje mock objekta za mysqli
        $mysqliMock = $this->getMockBuilder(stdClass::class)
                           ->setMethods(['query'])
                           ->getMock();

        // Očekivano ponašanje: funkcija query će biti pozvana tačno jednom sa odgovarajućim SQL upitom
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->with($this->stringContains("INSERT INTO comments"))
                   ->willReturn(true); // Simulacija uspešnog izvršavanja upita

        // Poziv funkcije za dodavanje komentara
        $result = addComment($mysqliMock, 123, "John", "Test comment");

        // Provera da li je rezultat dodavanja komentara tačan
        $this->assertTrue($result);
    }
}
