# rss-feed-reader
Simple RSS Feed Reader using PHP and CSV file as the store of the URLs of XMLs.

**Note:**
`This reader works only with RSS 2.0 standards` 

## In This Project:
1. I built the XML Parser using PHP `XMLReader` class.
2. I used a csv file to store the urls, it is found in `store/store.csv`


## To Use this project:

1. clone the project
2. open terminal in the project directory and run `composer install`
3. in the project directory, run `php -S localhost:8000`
4. open `localhost:8000` in the browser.


**Notes:** This project is not finished, I am trying to optimize it currently.

## Things to develop:
1. optimize the performance.
2. change `csv` to a database
3. enhance front-ent
4. make code more cleaner.