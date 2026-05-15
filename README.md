# staff-leave-managment-system
Create Staff leave  management  where   employee  apply the leave and manage approve  the leave

## Setup Instructions

### Environment Configuration
The database connection has been configured in the `.env` file:
- **DB_DATABASE**: `staff_managment_db`
- **DB_USERNAME**: `root`
- **DB_PASSWORD**: `123`

### Database Seeding
To populate the database with initial data, run:
```bash
php artisan migrate --seed
```

This will seed the database with:
1. **Admin User**:
   - **Email**: `admin@yopmail.com`
   - **Password**: `Admin@123`
   - **Role**: `admin`
2. **Leave Types**:
   - Annual Leave (12 days/year)
   - Sick Leave (6 days/year)
   - Casual Leave (5 days/year)