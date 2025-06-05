from django.shortcuts import render, get_object_or_404
from .models import User

# Create your views here.

def user_list(request):
    # Fetch a single user by ID (e.g., user with id=1)
    # Use get_object_or_404 to return a 404 error if the user is not found
    user = get_object_or_404(User, id=1)
    # Prepare the context to pass the single user object to the template
    context = {'user': user}
    # Render the template, passing the context
    return render(request, 'users_app/user_list.html', context)
