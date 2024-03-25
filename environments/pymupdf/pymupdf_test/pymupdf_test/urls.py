from django.contrib import admin
from django.urls import include, path

urlpatterns = [
    path("", include("base.urls")),
    path("injection/", include("injection.urls")),
    path("buffer/", include("buffer.urls")),
    path("osi/", include("osi.urls")),
    path('admin/', admin.site.urls)
]
