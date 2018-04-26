# -*- coding: utf-8 -*-
import requests
from bs4 import BeautifulSoup
import os
import json
import sys


def shellquote(s):
    return "'" + s.replace("'", "'\\''") + "'"

def getText(dirty, str):
    return str.replace(dirty, "")

def getBookInformathon ():
    headers = {
        'Upgrade-Insecure-Requests': '1',
        'Referer': 'https://isbndb.com',
        'User-Agent': "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_6) AppleWebKit/537.36 (KHTML, like Gecko) "
                      "Chrome/63.0.3239.132 Safari/537.36"
    }
    url_prefix = 'https://isbndb.com/search/books/'

    # isbn = input("isbn=");
    isbn = sys.argv[1]

    html = requests.get(url_prefix + isbn, headers = headers)
    html.encoding = 'utf8'
    Soap = BeautifulSoup(html.text, 'lxml')
    books = Soap.find_all('div', class_ = 'row book-row')
    results = list();
    for book in books:
        result = {}
        img_url = book.find('object', class_ = 'img-responsive')['data'].strip()
        title = book.find('h2', class_ = 'search-result-title').find('a').text.strip()
        authors = ""
        fullTitle = ""
        ISBN = ""
        ISBN13 = ""
        publisher = ""
        publishDate = ""
        informations = book.find_all('dt')
        for dt in informations:
            strong = dt.find('strong').text.strip()
            if strong == 'Authors:':
                authors = dt.find('a').text.strip()
            elif strong == 'Full Title:':
                fullTitle = getText("Full Title:", dt.text).strip()
            elif strong == 'ISBN:':
                ISBN = getText("ISBN:", dt.text).strip()
            elif strong == 'ISBN13:':
                ISBN13 = getText("ISBN13:", dt.text).strip()
            elif strong == 'Publisher:':
                publisher = dt.find('a').text.strip()
            elif strong == 'Publish Date:':
                publishDate = getText("Publish Date:", dt.text).strip()
        result['img_url'] = img_url
        result['title'] = title
        result['authors'] = authors
        result['fullTitle'] = fullTitle
        result['ISBN'] = ISBN
        result['ISBN13'] = ISBN13
        result['publisher'] = publisher
        result['publishDate'] = publishDate
        results.append(result)
    #    print('---------------------')
    jsonStr = json.dumps(results)
    return jsonStr;
if __name__ == '__main__':
    res = getBookInformathon()
    file = sys.argv[2]
    # f = open(os.getcwd() + "/../../../storage/test", "w")
    f = open(file, "w")
    print(res, file = f)
    f.close()
# 9787030500298
