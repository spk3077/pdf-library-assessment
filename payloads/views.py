from django.shortcuts import render
from django.http import HttpResponse

NUM_CALC = 900

def factorial(n):
    if n == 0:
        return 1
    else:
        return n * factorial(n-1)


def index(request):
    result = factorial(NUM_CALC)
    return HttpResponse(f"The factorial of {NUM_CALC} is {result}")
