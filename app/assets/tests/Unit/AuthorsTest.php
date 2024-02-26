<?php

use PHPUnit\Framework\TestCase;

function updateAuthorCategory($mysqli, $author_id, $category_id)
{
    // Simulacija upita za ažuriranje kategorije autora
    $query = "UPDATE author SET category_id = $category_id WHERE author_id = $author_id";
    $result = $mysqli->query($query); // Promenjeno da koristi $mysqli objekat
    return $result !== false; // Vraćamo true ako je upit uspešno izvršen, u suprotnom false
}

function addAuthorToAdmin($mysqli, $author_id)
{
    // Simulacija upita za dodavanje autora u ulogu urednika
    $query = "INSERT INTO admin (author_id) VALUES ($author_id)";
    $result = $mysqli->query($query); // Promenjeno da koristi $mysqli objekat
    return $result !== false; // Vraćamo true ako je upit uspešno izvršen, u suprotnom false
}

function removeAuthorFromAdmin($mysqli, $author_id)
{
    // Simulacija upita za uklanjanje autora iz uloge urednika
    $query = "DELETE FROM admin WHERE author_id = $author_id";
    $result = $mysqli->query($query); // Promenjeno da koristi $mysqli objekat
    return $result !== false; // Vraćamo true ako je upit uspešno izvršen, u suprotnom false
}

function deleteAuthor($mysqli, $author_id)
{
    // Simulacija upita za brisanje autora
    $query = "DELETE FROM author WHERE author_id = $author_id";
    $result = $mysqli->query($query); // Promenjeno da koristi $mysqli objekat
    return $result !== false; // Vraćamo true ako je upit uspešno izvršen, u suprotnom false
}

class AuthorsTest extends TestCase
{
    public function testUpdateAuthorCategory()
    {
        // Kreiranje mock objekta za mysqli
        $mysqliMock = $this->getMockBuilder(stdClass::class)
                           ->setMethods(['query'])
                           ->getMock();

        // Očekivano ponašanje: funkcija query će biti pozvana tačno jednom sa odgovarajućim SQL upitom
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->with($this->equalTo("UPDATE author SET category_id = 2 WHERE author_id = 123"))
                   ->willReturn(true); // Simulacija uspešnog izvršavanja upita

        // Poziv funkcije za ažuriranje kategorije autora
        $result = updateAuthorCategory($mysqliMock, 123, 2);

        // Provera da li je rezultat ažuriranja tačan
        $this->assertTrue($result);
    }

    public function testAddAuthorToAdmin()
    {
        // Kreiranje mock objekta za mysqli
        $mysqliMock = $this->getMockBuilder(stdClass::class)
                           ->setMethods(['query'])
                           ->getMock();

        // Očekivano ponašanje: funkcija query će biti pozvana tačno jednom sa odgovarajućim SQL upitom
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->with($this->equalTo("INSERT INTO admin (author_id) VALUES (123)"))
                   ->willReturn(true); // Simulacija uspešnog izvršavanja upita

        // Poziv funkcije za dodavanje autora u ulogu urednika
        $result = addAuthorToAdmin($mysqliMock, 123);

        // Provera da li je rezultat dodavanja tačan
        $this->assertTrue($result);
    }

    public function testRemoveAuthorFromAdmin()
    {
        // Kreiranje mock objekta za mysqli
        $mysqliMock = $this->getMockBuilder(stdClass::class)
                           ->setMethods(['query'])
                           ->getMock();

        // Očekivano ponašanje: funkcija query će biti pozvana tačno jednom sa odgovarajućim SQL upitom
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->with($this->equalTo("DELETE FROM admin WHERE author_id = 123"))
                   ->willReturn(true); // Simulacija uspešnog izvršavanja upita

        // Poziv funkcije za uklanjanje autora iz uloge urednika
        $result = removeAuthorFromAdmin($mysqliMock, 123);

        // Provera da li je rezultat uklanjanja tačan
        $this->assertTrue($result);
    }

    public function testDeleteAuthor()
    {
        // Kreiranje mock objekta za mysqli
        $mysqliMock = $this->getMockBuilder(stdClass::class)
                           ->setMethods(['query'])
                           ->getMock();

        // Očekivano ponašanje: funkcija query će biti pozvana tačno jednom sa odgovarajućim SQL upitom
        $mysqliMock->expects($this->once())
                   ->method('query')
                   ->with($this->equalTo("DELETE FROM author WHERE author_id = 123"))
                   ->willReturn(true); // Simulacija uspešnog izvršavanja upita

        // Poziv funkcije za brisanje autora
        $result = deleteAuthor($mysqliMock, 123);

        // Provera da li je rezultat brisanja tačan
        $this->assertTrue($result);
    }
}
