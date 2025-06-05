from django.core.management.base import BaseCommand
from users_app.models import User
import random
import string

class Command(BaseCommand):
    help = 'Adds random users to the database'

    def handle(self, *args, **kwargs):
        self.stdout.write('Adding random users...')

        genders = ['Male', 'Female', 'Other']
        nationalities = ['USA', 'Canada', 'Mexico', 'UK', 'Germany', 'France', 'Japan']
        universities = ['State University', 'City College', 'Tech Institute', 'Arts School']
        hobbies = ['Reading', 'Hiking', 'Gaming', 'Cooking', 'Photography', 'Sports']

        for i in range(10): # Add 10 random users
            first_name = ''.join(random.choices(string.ascii_letters, k=random.randint(5, 10)))
            last_name = ''.join(random.choices(string.ascii_letters, k=random.randint(5, 10)))
            age = random.randint(18, 60)
            gender = random.choice(genders)
            nationality = random.choice(nationalities)
            address = f'Street {random.randint(1, 100)}'
            university_name = random.choice(universities)
            semester_number = random.randint(1, 8)
            gpa = round(random.uniform(2.0, 4.0), 2)
            hobby = random.choice(hobbies)

            User.objects.create(
                first_name=first_name,
                last_name=last_name,
                age=age,
                gender=gender,
                nationality=nationality,
                address=address,
                university_name=university_name,
                semester_number=semester_number,
                gpa=gpa,
                hobby=hobby
            )

        self.stdout.write(self.style.SUCCESS('Successfully added 10 random users.'))