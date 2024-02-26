<?php

use PHPUnit\Framework\TestCase;

function deactivateArticle($mysqli, $article_id)
{
    // Simulacija upita za deaktivaciju članka
    $query = "UPDATE article SET article_active = 0 WHERE article_id = $article_id";
    $result = $mysqli->query($query); // Promenjeno da koristi $mysqli objekat
    return $result !== false; // Vraćamo true ako je upit uspešno izvršen, u suprotnom false
}

function activateArticle($mysqli, $article_id)
{
    // Simulacija upita za aktivaciju članka
    $query = "UPDATE article SET article_active = 1 WHERE article_id = $article_id";
    $result = $mysqli->query($query); // Promenjeno da koristi $mysqli objekat
    return $result !== false; // Vraćamo true ako je upit uspešno izvršen, u suprotnom false
}

function deleteArticle($mysqli, $article_id)
{
    // Simulacija upita za brisanje članka
    $query = "DELETE FROM article WHERE article_id = $article_id";
    $result = $mysqli->query($query); // Promenjeno da koristi $mysqli objekat
    return $result !== false; // Vraćamo true ako je upit uspešno izvršen, u suprotnom false
}

class ArticlesTest extends TestCase
{
    public function testDeactivateArticle()
    {
        // Kreiranje mock objekta za mysqli
        $mysqliMock = $this->getMockBuilder(stdClass::class)
                           ->setMethods(['query'])
                           ->getMock();

        // Očekivano ponašanje: funkcija query će biti pozvana tačno jednom sa odgovarajućim SQL upitom
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->with($this->equalTo("UPDATE article SET article_active = 0 WHERE article_id = 123"))
                   ->willReturn(true); // Simulacija uspešnog izvršavanja upita

        // Poziv funkcije za deaktivaciju članka
        $result = deactivateArticle($mysqliMock, 123);

        // Provera da li je rezultat deaktivacije tačan
        $this->assertTrue($result);
    }

    public function testActivateArticle()
    {
        // Kreiranje mock objekta za mysqli
        $mysqliMock = $this->getMockBuilder(stdClass::class)
                           ->setMethods(['query'])
                           ->getMock();

        // Očekivano ponašanje: funkcija query će biti pozvana tačno jednom sa odgovarajućim SQL upitom
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->with($this->equalTo("UPDATE article SET article_active = 1 WHERE article_id = 123"))
                   ->willReturn(true); // Simulacija uspešnog izvršavanja upita

        // Poziv funkcije za aktivaciju članka
        $result = activateArticle($mysqliMock, 123);

        // Provera da li je rezultat aktivacije tačan
        $this->assertTrue($result);
    }

    public function testDeleteArticle()
    {
        // Kreiranje mock objekta za mysqli
        $mysqliMock = $this->getMockBuilder(stdClass::class)
                           ->setMethods(['query'])
                           ->getMock();

        // Očekivano ponašanje: funkcija query će biti pozvana tačno jednom sa odgovarajućim SQL upitom
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->with($this->equalTo("DELETE FROM article WHERE article_id = 123"))
                   ->willReturn(true); // Simulacija uspešnog izvršavanja upita

        // Poziv funkcije za brisanje članka
        $result = deleteArticle($mysqliMock, 123);

        // Provera da li je rezultat brisanja tačan
        $this->assertTrue($result);
    }
}
