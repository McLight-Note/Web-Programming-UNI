import os
import django

os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'sports_project.settings')
django.setup()

from sports_app.models import Sport

sports_data = [
    ("Soccer", 10),
    ("basketball", 23),
    ("Tennis ball", 67),
    ("Golf", 78),
    ("Volleyball", 8),
    ("Badminton", 2),
    ("boxing", 98),
    ("Swimming", 99),
    ("Hiking", 10),
    ("Jumping", 53)
]

def load_data():
    print("Loading sports data...")
    for name, rating in sports_data:
        # Check if the sport already exists to avoid duplicates
        if not Sport.objects.filter(name=name).exists():
            Sport.objects.create(name=name, rating=rating)
            print(f"Added: {name}")
        else:
            print(f"Skipped: {name} (already exists)")
    print("Data loading complete.")

if __name__ == '__main__':
    load_data() 