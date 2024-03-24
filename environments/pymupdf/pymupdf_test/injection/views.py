from django.shortcuts import render
from django.http import HttpResponse

import sys

sys.path.insert(0, "/usr/src/app")
from py_payloads import escape_seq

def index(request):
    

    return HttpResponse("INJECTION")
