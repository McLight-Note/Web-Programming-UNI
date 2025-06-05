from django.urls import path
from . import views

urlpatterns = [
    path('sports/', views.top_sports_view, name='top_sports'),
] 