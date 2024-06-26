from django.shortcuts import render
from django.http import HttpResponse

import sys
import os

import fitz

sys.path.insert(0, "/usr/src/app")
from py_payloads import os_commands

def check_test_file(endpoint: str, command: str) -> str:
    if os.path.exists('/usr/src/app/test'):
        os.unlink('/usr/src/app/test')
        print("Endpoint: " + endpoint + " Command: " + command)
        return "Endpoint: " + endpoint + " Command: " + command + " | "
    else:
        return ""

def index(request):
    ret: str = "OS INJECTION: "
    # Delete existing PDFs
    file_paths = []  # List to store file paths
    for root, directories, files in os.walk("/pdfs/"):
        for filename in files:
            filepath = os.path.join(root, filename)
            file_paths.append(filepath)

    for pdf_path in file_paths:
        os.unlink(pdf_path)

    # Author
    count: int = 0
    for seq in os_commands:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": seq,
            "title": "Title",
            "subject": "Subject",
            "keywords": "keyword1, keyword2",
            "creator": "Creator",
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        doc.save("/pdfs/author" + str(count) + ".pdf")
        ret += check_test_file("Author", seq)
        count += 1

    # Title
    count: int = 0
    for seq in os_commands:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": seq,
            "subject": "Subject",
            "keywords": "keyword1, keyword2",
            "creator": "Creator",
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        doc.save("/pdfs/title" + str(count) + ".pdf")
        ret += check_test_file("Title", seq)
        count += 1

    # Subject
    count: int = 0
    for seq in os_commands:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "Title",
            "subject": seq,
            "keywords": "keyword1, keyword2",
            "creator": "Creator",
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        doc.save("/pdfs/subject" + str(count) + ".pdf")
        ret += check_test_file("Subject", seq)
        count += 1

    # Keywords
    count: int = 0
    for seq in os_commands:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "Title",
            "subject": "Subject",
            "keywords": seq,
            "creator": "Creator",
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        doc.save("/pdfs/keywords" + str(count) + ".pdf")
        ret += check_test_file("Keywords", seq)
        count += 1

    # Creator
    count: int = 0
    for seq in os_commands:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "Title",
            "subject": "Subject",
            "keywords": "keyword1, keyword2",
            "creator": seq,
            "producer": "Producer"
        }
        doc.set_metadata(new_metadata)
        doc.save("/pdfs/creator" + str(count) + ".pdf")
        ret += check_test_file("Creator", seq)
        count += 1

    # Producer
    count: int = 0
    for seq in os_commands:
        doc = fitz.open()
        page = doc.new_page()
        new_metadata = {
            "author": "Author",
            "title": "Title",
            "subject": "Subject",
            "keywords": "keyword1, keyword2",
            "creator": "Creator",
            "producer": seq
        }
        doc.set_metadata(new_metadata)
        doc.save("/pdfs/producer" + str(count) + ".pdf")
        ret += check_test_file("Producer", seq)
        count += 1

    # Text
    count: int = 0
    for seq in os_commands:
        doc = fitz.open()
        page = doc.new_page()
        page.insert_text((50, 100), seq, fontname="helv", fontsize=12)
        doc.save("/pdfs/text" + str(count) + ".pdf")
        ret += check_test_file("Text", seq)
        count += 1

    # HTMLbox
    count: int = 0
    for seq in os_commands:
        doc = fitz.open()
        page = doc.new_page()
        page.insert_htmlbox(fitz.Rect(0,0,50,50), seq, css="* {font-family: sans-serif;font-size:14px;}")
        doc.save("/pdfs/htmlbox" + str(count) + ".pdf")
        ret += check_test_file("HTMLBox", seq)
        count += 1

    # Link
    count: int = 0
    for seq in os_commands:
        doc = fitz.open()
        page = doc.new_page()
        link = {
            "kind": fitz.LINK_URI,
            "uri": seq,
            "from": fitz.Rect(0,0,50,50)
        }
        page.insert_link(link)
        doc.save("/pdfs/link" + str(count) + ".pdf")
        ret += check_test_file("Link", seq)
        count += 1

    # Output
    for seq in os_commands:
        doc = fitz.open()
        page = doc.new_page()
        doc.save("/pdfs/output" + seq)
        ret += check_test_file("Output", seq)

    return HttpResponse(ret)
