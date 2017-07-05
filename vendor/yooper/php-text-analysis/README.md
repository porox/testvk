php-text-analysis
=============
![alt text](https://travis-ci.org/yooper/php-text-analysis.svg?branch=master "Build status")

![Total Downloads](https://img.shields.io/packagist/dt/php-text-analysis/php-text-analysis.svg)

PHP Text Analysis is a library for performing Information Retrieval (IR) and Natural Language Processing (NLP) tasks using the PHP language. All the documentation for this project can be found in the wiki. 

Installation Instructions
=============

Add PHP Text Analysis to your project
```
composer require yooper/php-text-analysis
```
Documentation for the library resides in the wiki. 
https://github.com/yooper/php-text-analysis/wiki




Dictionary Installation
=============

Not required unless you use the dictionary stemmers

*For Ubuntu < 16*
```
sudo apt-get install libpspell-dev 
sudo apt-get install php5-pspell
sudo apt-get install aspell-en
sudo apt-get install php5-enchant
```
*For Ubuntu >= 16*
```
sudo apt-get install libpspell-dev php7.0-pspell aspell-en php7.0-enchant
```


*For Centos* 
```
sudo yum install php5-pspell
sudo yum install aspell-en
sudo yum install php5-enchant
```

*PHP Pecl Stem* is not currently available in php 7.0. 


Tokenize
=============

There are several tokenizers available 

 * FixedLengthTokenizer
 * GeneralTokenizer
 * LambdaTokenizer
 * PennTreeBankTokenizer
 * RegexTokenizer
 * SentenceTokenizer 
 * WhitespaceTokenizer

*Tokenizer Usage*
```
$tokenizer = new GeneralTokenizer()
$tokens = $tokenizer->tokenize("Enter your text here");
```

Frequency Distribution
=============
```
$tokenizer = new \TextAnalysis\Tokenizers\GeneralTokenizer();
$tokens = $tokenizer->tokenize("time flies like an arrow and an arrow flies like time");
$freqDist = new \TextAnalysis\Analysis\FreqDist($tokens);
$freqDist->getHapaxes(); //Get the Hapaxes
$freqDist->getTotalTokens();
$freqDist->getTotalUniqueTokens();
```
Check out the API for full documentation
https://github.com/yooper/php-text-analysis/blob/master/src/Analysis/FreqDist.php

 
