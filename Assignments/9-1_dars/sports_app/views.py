from django.shortcuts import render
from .models import Sport

# Create your views here.

def top_sports_view(request):
    # Query for all sports
    famous_sports = Sport.objects.all().order_by('-rating')
    
    # Pass the data to the template
    context = {
        'famous_sports': famous_sports
    }
    
    return render(request, 'sports_app/top_sports.html', context)
