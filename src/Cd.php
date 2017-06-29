<?php

    class Cd
    {
        private $album;
        private $artist;


        function __construct($album, $artist)
        {
            $this->album = $album;
            $this->artist = $artist;

        }

        // function setAlbum($new_album)
        // {
        //     $this->album = $new_album;
        // }

        function getAlbum()
        {
            return $this->album;
        }

        // function setArtist($new_artist)
        // {
        //     $this->artist = $new_artist;
        // }

        function getArtist()
        {
            return $this->artist;
        }

        function save()
        {
            array_push($_SESSION['list_of_cds'], $this);
        }

        static function getAll()
        {
            return $_SESSION['list_of_cds'];
        }

        static function deleteAll()
        {
            return $_SESSION['list_of_cds'] = array();
        }


    }


 ?>
