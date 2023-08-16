<?php

declare(strict_types=1);

namespace RssFeedReader\RssParser;

class RssParser
{
    private \XMLReader $reader;

    public function __construct()
    {
        $this->reader = new \XMLReader();
    }

    public function getAllItems($url)
    {
        $itemsArray = [];

        try {

            $this->reader->open($url);

            $this->reader->read(); // read rss tag
            $this->reader->read(); // read  text rss
            $this->reader->read(); // read channel tag


            while ($this->reader->read()) {

                if ($this->reader->nodeType === \XMLReader::ELEMENT && $this->reader->name === 'item') {
                    $item = [];
                    while ($this->reader->read() && $this->reader->name !== 'item') {
                        if ($this->reader->nodeType === \XMLReader::ELEMENT && $this->reader->name === 'title') {
                            $item['title'] = $this->reader->readString();
                        } elseif ($this->reader->nodeType === \XMLReader::ELEMENT && $this->reader->name === 'link') {
                            $item['link'] = $this->reader->readString();
                        } elseif ($this->reader->nodeType === \XMLReader::ELEMENT && $this->reader->name === 'description') {
                            $item['description'] = $this->reader->readString();
                        }
                    }

                    $itemsArray[] = $item;
                }
            }

            $this->reader->close();

        } catch (\Exception $e) {
            echo "Can't not Parse The Rss";
            return [];
        }

        return $itemsArray;
    }

}