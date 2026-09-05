# SaaS LMS Platform Documentation

## 1. Executive Summary

This project is a Laravel-based Learning Management System (LMS) that currently provides a public course discovery website, an admin back office, and an instructor portal. The current implementation includes authentication guards for admins and instructors, profile management, category and sub-category management, banner management, instructor management, and instructor-owned course management.

The long-term objective is to evolve the project into a complete, scalable, production-ready SaaS LMS platform where multiple organizations, schools, academies, trainers, or businesses can run isolated learning portals from one shared application. The target platform should support subscriptions, payments, multi-tenancy, student enrollment, lessons, assessments, certificates, reporting, notifications, integrations, and secure APIs.

## 2. Project Objectives

- Provide a complete SaaS LMS that supports multiple tenant organizations from one codebase.
- Allow platform administrators to manage tenants, billing plans, system-wide settings, compliance, reporting, and operational health.
- Allow tenant administrators to manage their own branded LMS portal, users, courses, instructors, enrollments, payments, and reports.
- Allow instructors to create, organize, publish, and monitor courses.
- Allow students to discover, enroll in, purchase, consume, complete, and review courses.
- Support subscription billing, one-time course purchases, coupons, invoices, taxes, refunds, and payment gateway integrations.
- Provide secure, scalable backend architecture with API support for web, mobile, and third-party integrations.
- Solve common LMS limitations including poor onboarding, weak analytics, difficult course authoring, limited customization, fragmented payments, lack of tenant isolation, and inadequate reporting.

## 3. Current Technology Stack

- Backend framework: Laravel 11
- Language/runtime: PHP 8.2+
- Frontend rendering: Blade templates
- Asset pipeline: Vite
- Styling/build tools: Tailwind CSS, PostCSS, Bootstrap/Sneat-style admin assets
- JavaScript utilities: Axios, jQuery
- Server-side data grids: Yajra Laravel DataTables
- Database: Laravel-supported relational database, configured through `.env`
- Queues: Laravel queue tables are present
- Testing: PHPUnit scaffold exists with default example tests

## 4. Existing Architecture

The codebase currently follows a controller-service-repository pattern for several core modules.

- Controllers handle HTTP request flow and view rendering.
- Form request classes validate admin, instructor, category, sub-category, banner, profile, password, and course inputs.
- Services coordinate business actions.
- Repositories persist models.
- Models represent users, categories, sub-categories, banners, and courses.
- Blade layouts separate admin, instructor, and public frontend shells.
- Custom auth guard middleware protects admin and instructor areas.
- Helper functions provide image upload, sidebar active-state handling, category loading, and instructor approval checks.

## 5. Completed Modules

### 5.1 Public Frontend

Completed:

- Home page route and controller.
- About page route and controller.
- Categories listing route and controller.
- Courses listing route and controller.
- Contact page route and controller.
- Frontend Blade layout and shared header/footer includes.
- Homepage/component structure for banners, categories, courses, featured sections, learning sections, fun facts, testimonials, partners, students, news, logo, and loader UI.
- Active category loading for public display.
- Active home banner loading for public display.
- Active course loading for home display.

Current files:

- `routes/web.php`
- `app/Http/Controllers/Frontend/*`
- `resources/views/frontend/*`
- `resources/views/components/*`
- `resources/views/layout/frontapp.blade.php`

### 5.2 Admin Authentication

Completed:

- Admin login route supporting GET and POST.
- Admin logout.
- Admin session guard configured in `config/auth.php`.
- Admin guard middleware checks authentication and active status.
- Role-based login filtering so only users with `role = admin` can access admin login.
- Inactive admin users are blocked from login.

Current files:

- `app/Http/Controllers/Admin/AuthController.php`
- `app/Http/Middleware/AuthGuardMiddleware.php`
- `config/auth.php`
- `routes/admin.php`

### 5.3 Admin Dashboard

Completed:

- Admin dashboard route.
- Admin dashboard view.
- Admin layout, navigation, sidebar, and footer includes.

Current files:

- `app/Http/Controllers/Admin/DashboardController.php`
- `resources/views/admin/dashboard.blade.php`
- `resources/views/layout/adminapp.blade.php`
- `resources/views/include/admin*.blade.php`

### 5.4 Admin Profile Management

Completed:

- View admin profile.
- Update profile details.
- Upload/change profile image.
- Show password update form.
- Update password after current password validation.
- Shared profile service/repository usable by admin and instructor.

Current files:

- `app/Http/Controllers/Admin/ProfileController.php`
- `app/Http/Requests/ProfileRequest.php`
- `app/Http/Requests/PasswordUpdateRequest.php`
- `app/Services/ProfileService.php`
- `app/Services/PasswordUpdateService.php`
- `app/Repositories/ProfileRepository.php`
- `app/Repositories/PasswordUpdateRepository.php`
- `resources/views/admin/profile/*`

### 5.5 Category Management

Completed:

- Admin category list.
- Create category.
- Edit category.
- Update category.
- Delete category.
- Category image upload.
- Category status management.
- Slug uniqueness validation.
- Yajra DataTables endpoint for category listing.
- Category model relationship to sub-categories.

Current files:

- `app/Models/Category.php`
- `database/migrations/2025_07_25_154304_create_categories_table.php`
- `app/Http/Controllers/Admin/CategoryController.php`
- `app/Http/Requests/CategoryRequest.php`
- `app/Services/CategoryService.php`
- `app/Repositories/CategoryRepository.php`
- `resources/views/admin/categories/*`

### 5.6 Sub-Category Management

Completed:

- Admin sub-category list.
- Create sub-category under an active category.
- Edit sub-category.
- Update sub-category.
- Delete sub-category.
- Slug uniqueness validation.
- Foreign key relationship to categories.
- Yajra DataTables endpoint for sub-category listing.

Current files:

- `app/Models/SubCategory.php`
- `database/migrations/2025_08_18_023244_create_sub_categories_table.php`
- `app/Http/Controllers/Admin/SubCategoryController.php`
- `app/Http/Requests/SubCategoryRequest.php`
- `app/Services/SubCategoryService.php`
- `app/Repositories/SubCategoryRepository.php`
- `resources/views/admin/sub-categories/*`

### 5.7 Banner Management

Completed:

- Admin banner list.
- Create banner.
- Edit banner.
- Update banner.
- Delete banner.
- Banner image upload.
- Banner page assignment.
- Sort order field.
- Active/inactive status.
- Yajra DataTables endpoint for banner listing.
- Public home page loading of active home banners.

Current files:

- `app/Models/Banner.php`
- `database/migrations/2025_09_01_172856_create_banners_table.php`
- `app/Http/Controllers/Admin/BannerController.php`
- `app/Http/Requests/BannerRequest.php`
- `app/Services/BannerService.php`
- `app/Repositories/BannerRepository.php`
- `resources/views/admin/banner/*`

### 5.8 Instructor Management By Admin

Completed:

- Admin instructor listing.
- Create instructor.
- Edit instructor.
- Update instructor.
- Delete instructor.
- Instructor profile image upload.
- Instructor role assignment.
- Instructor password hashing.
- Instructor active/inactive status.
- Yajra DataTables endpoint for instructor listing.

Current files:

- `app/Http/Controllers/Admin/ManageInstructorController.php`
- `app/Http/Requests/InstructorRequest.php`
- `app/Services/InstructorService.php`
- `app/Repositories/InstructorRepository.php`
- `resources/views/admin/instructor/*`

### 5.9 Instructor Authentication

Completed:

- Instructor login route supporting GET and POST.
- Instructor logout.
- Instructor session guard configured in `config/auth.php`.
- Instructor guard middleware checks authentication and active status.
- Role-based login filtering so only users with `role = instructor` can access instructor login.
- Inactive instructors are blocked from login.

Current files:

- `app/Http/Controllers/Instructor/AuthController.php`
- `routes/instructor.php`
- `config/auth.php`

### 5.10 Instructor Dashboard

Completed:

- Instructor dashboard route.
- Instructor dashboard view.
- Instructor layout, navigation, and sidebar includes.

Current files:

- `app/Http/Controllers/Instructor/DashboardController.php`
- `resources/views/instructor/dashboard.blade.php`
- `resources/views/layout/instructorapp.blade.php`
- `resources/views/include/instructor*.blade.php`

### 5.11 Instructor Profile Management

Completed:

- View instructor profile.
- Update instructor profile.
- Upload/change profile image.
- Show password update form.
- Update password after current password validation.

Current files:

- `app/Http/Controllers/Instructor/ProfileController.php`
- `resources/views/instructor/profile/*`

### 5.12 Instructor Course Management

Completed:

- Instructor course list scoped to logged-in instructor.
- Create course.
- Edit course.
- Update course.
- Delete course.
- Course image upload.
- Category and sub-category assignment.
- Instructor assignment field.
- Course title, slug, name, description, video URL, label, resources, certificate, prices, prerequisites, bestseller, featured, highest-rated, and status fields.
- Yajra DataTables endpoint for instructor courses.
- Public home page can load active courses.

Current files:

- `app/Models/Course.php`
- `database/migrations/2025_10_23_031154_create_courses_table.php`
- `app/Http/Controllers/Instructor/CourseController.php`
- `app/Http/Requests/CourseRequest.php`
- `app/Services/CourseService.php`
- `app/Repositories/CourseRepository.php`
- `resources/views/instructor/courses/*`

### 5.13 Core Database Foundation

Completed:

- Users table with role, status, profile, biography, experience, contact, address, and demographic fields.
- Password reset token table.
- Sessions table.
- Cache and cache lock tables.
- Queue job, job batch, and failed job tables.
- Category, sub-category, banner, and course tables.

### 5.14 File Upload Foundation

Completed:

- Shared `upload_image()` helper.
- Public image directories for profile, users, categories, courses, and banners.
- Basic file validation in form requests.

## 6. In Progress / Partially Implemented Modules

### 6.1 Student/User Module

Current state:

- `user` role exists in the users table.
- Public user routes are present as commented code in `routes/web.php`.
- No active student login, registration, dashboard, enrollment, learning, purchase, profile, or progress workflows are implemented.

Needed next:

- Student authentication and registration.
- Student dashboard.
- Course enrollment and learning pages.
- Progress tracking.
- Orders and invoices.
- Certificates.
- Reviews and discussions.

### 6.2 Course Catalog And Detail Experience

Current state:

- Public course listing route/view exists.
- Home page loads active courses.
- Course detail, filtering, search, sorting, wishlist, preview lessons, reviews, pricing logic, and enrollment CTAs are not yet complete.

Needed next:

- Course detail pages by slug.
- Course filters by category, sub-category, instructor, level, price, rating, language, duration, and certificate.
- Search indexing.
- Course preview videos.
- Enrollment and checkout entry points.

### 6.3 Admin Contact And Info Pages

Current state:

- Admin contact view exists.
- Admin info route exists, but the controller has no implemented actions.
- No contact submission model, database table, workflow, notifications, or status tracking exists.

Needed next:

- Contact inquiries table.
- Admin inquiry inbox.
- Reply/status workflow.
- Site info/content settings CRUD.

### 6.4 Course Content Management

Current state:

- Course-level metadata exists.
- Lesson, section, module, video, attachment, quiz, assignment, live class, and drip-schedule structures are missing.

Needed next:

- Curriculum builder.
- Sections/modules.
- Lessons with video, text, audio, downloadable resources, embeds, and SCORM/xAPI support.
- Draft/review/publish workflow.

### 6.5 Testing And Quality Assurance

Current state:

- PHPUnit is configured.
- Only default example tests exist.

Needed next:

- Feature tests for authentication, CRUD, permissions, file uploads, course ownership, validation, payments, tenancy, and API behavior.
- Unit tests for services and repositories.
- Browser tests for critical dashboards and learning workflows.

## 7. Remaining / Required Modules For A Complete SaaS LMS

### 7.1 SaaS Multi-Tenancy

Required features:

- Tenant model representing schools, academies, companies, teams, or creators.
- Tenant owner account.
- Tenant-aware users, courses, categories, enrollments, orders, settings, reports, notifications, and files.
- Tenant isolation by `tenant_id` or schema/database separation.
- Tenant onboarding wizard.
- Tenant status lifecycle: trial, active, past due, suspended, cancelled.
- Custom domains and subdomains.
- Tenant branding: logo, favicon, colors, email templates, certificate templates, portal copy.
- Tenant feature flags based on subscription plan.
- Tenant storage quotas, user limits, course limits, bandwidth limits, and API limits.
- Super admin impersonation with audit logs.
- Tenant data export and deletion workflow.

Suggested database tables:

- `tenants`
- `tenant_users`
- `tenant_domains`
- `tenant_settings`
- `tenant_feature_flags`
- `tenant_usage_metrics`
- `tenant_audit_logs`

### 7.2 Subscription And Billing

Required features:

- SaaS subscription plans.
- Free trials.
- Monthly and annual billing.
- Seat-based billing.
- Usage-based billing for storage, AI features, video bandwidth, or certificates.
- Tenant plan upgrades/downgrades.
- Payment gateway integration such as Stripe, PayPal, Razorpay, or local payment providers.
- Invoices and receipts.
- Tax/VAT/GST handling.
- Coupons, discounts, promotional codes.
- Failed payment retries.
- Dunning emails.
- Refunds and credit notes.
- Billing portal.
- Webhook processing.
- Billing audit trail.

Suggested database tables:

- `plans`
- `plan_features`
- `subscriptions`
- `subscription_items`
- `payment_methods`
- `invoices`
- `invoice_items`
- `transactions`
- `coupons`
- `refunds`
- `webhook_events`

### 7.3 Student Learning Experience

Required features:

- Student registration and login.
- Student dashboard.
- Course enrollment.
- Learning player.
- Lesson completion tracking.
- Continue learning.
- Course progress percentage.
- Bookmarks and notes.
- Downloadable resources.
- Assignments and submissions.
- Quizzes and exams.
- Grades and feedback.
- Certificates.
- Wishlist.
- Reviews and ratings.
- Course discussions.
- Announcements.
- Calendar for deadlines and live classes.
- Learning reminders.
- Accessibility support including captions, transcripts, keyboard navigation, and screen reader compatibility.

Suggested database tables:

- `enrollments`
- `course_sections`
- `lessons`
- `lesson_assets`
- `lesson_progress`
- `student_notes`
- `student_bookmarks`
- `course_reviews`
- `course_discussions`
- `announcements`

### 7.4 Course Authoring And Content Management

Required features:

- Drag-and-drop curriculum builder.
- Course draft, review, published, archived, rejected states.
- Course approval workflow.
- Version history.
- Lesson types: video, article, downloadable file, quiz, assignment, live session, embedded content.
- Bulk upload.
- Media library.
- Video processing and streaming integration.
- SCORM/xAPI import support.
- Prerequisite courses and locked lessons.
- Drip content schedules.
- Course cohorts and batches.
- Instructor collaboration.
- Course cloning.
- Localization support.

Suggested database tables:

- `course_versions`
- `course_sections`
- `lessons`
- `lesson_files`
- `course_requirements`
- `course_outcomes`
- `course_faqs`
- `course_languages`
- `course_approvals`

### 7.5 Assessments, Exams, And Assignments

Required features:

- Question bank.
- Question types: multiple choice, multiple select, true/false, short answer, essay, file upload, coding task, matching, ordering.
- Quiz builder.
- Randomized questions.
- Timed exams.
- Attempt limits.
- Passing scores.
- Auto-grading and manual grading.
- Assignment submissions.
- Rubrics.
- Instructor feedback.
- Plagiarism checks.
- Gradebook.
- Retake rules.
- Proctoring integration for high-stakes exams.

Suggested database tables:

- `question_banks`
- `questions`
- `question_options`
- `quizzes`
- `quiz_questions`
- `quiz_attempts`
- `quiz_answers`
- `assignments`
- `assignment_submissions`
- `grades`
- `rubrics`

### 7.6 Certificates And Credentials

Required features:

- Certificate templates.
- Automatic certificate generation after completion.
- Unique certificate IDs.
- Public certificate verification.
- Expiry dates.
- Renewal workflows.
- Badges and micro-credentials.
- PDF generation.
- Tenant-branded certificates.

Suggested database tables:

- `certificate_templates`
- `issued_certificates`
- `badges`
- `student_badges`

### 7.7 Reporting And Analytics

Required features:

- Platform admin analytics.
- Tenant analytics.
- Instructor analytics.
- Student analytics.
- Revenue reports.
- Subscription metrics: MRR, ARR, churn, trial conversion, failed payments.
- Course performance: enrollments, completion rate, average rating, revenue, drop-off points.
- Student progress reports.
- Quiz and assessment reports.
- Instructor performance reports.
- Cohort and batch reports.
- Export to CSV/XLSX/PDF.
- Scheduled reports.
- Custom report builder.
- Audit reports.

Suggested database tables:

- `activity_logs`
- `learning_events`
- `report_exports`
- `analytics_snapshots`

### 7.8 Notifications And Communication

Required features:

- Email notifications.
- In-app notifications.
- SMS/WhatsApp integration where required.
- Push notifications for mobile/PWA.
- Notification templates per tenant.
- Course announcements.
- Enrollment confirmation.
- Payment confirmation.
- Password reset.
- Course completion.
- Certificate issued.
- Assignment feedback.
- Deadline reminders.
- Failed payment notices.
- Admin alerts.
- Queue-backed delivery.
- Notification preferences.

Suggested database tables:

- `notifications`
- `notification_templates`
- `notification_preferences`
- `message_threads`
- `messages`

### 7.9 Admin Roles And Permissions

Required roles:

- Super Admin: owns the SaaS platform, manages tenants, plans, billing, global settings, system health, and compliance.
- Platform Support Agent: assists tenants and users with restricted access and audited impersonation.
- Tenant Owner: owns one tenant account, billing, branding, tenant settings, and tenant admins.
- Tenant Admin: manages tenant users, courses, enrollments, reports, and settings.
- Instructor/Teacher: creates and manages assigned courses, lessons, assessments, discussions, and student feedback.
- Teaching Assistant/Mentor: supports grading, discussions, and learner assistance for assigned courses.
- Student/Learner: enrolls in courses, consumes lessons, submits assignments, takes quizzes, tracks progress, and receives certificates.
- Finance Manager: views invoices, payments, refunds, commissions, taxes, and revenue reports.
- Content Reviewer: reviews and approves course content before publishing.
- Affiliate/Partner: promotes courses and tracks referrals where marketplace features are enabled.

Required permission model:

- Role-based access control.
- Permission-based policies for granular actions.
- Tenant-scoped permissions.
- Course-scoped permissions for instructors and assistants.
- Audit logs for sensitive actions.
- Optional custom roles per tenant.

Suggested permissions:

- Manage tenants
- Manage plans
- Manage billing
- Manage users
- Manage roles
- Manage instructors
- Manage categories
- Manage courses
- Approve courses
- Publish courses
- Manage enrollments
- Manage payments
- Manage reports
- Manage certificates
- Manage tenant branding
- Manage integrations
- View audit logs
- Impersonate users

### 7.10 Dashboards

Required dashboards:

- Super Admin Dashboard:
    - Total tenants
    - Active subscriptions
    - Trial accounts
    - MRR/ARR
    - Failed payments
    - Platform revenue
    - User growth
    - Course growth
    - System health
    - Recent activity

- Tenant Admin Dashboard:
    - Total students
    - Total instructors
    - Active courses
    - Enrollments
    - Revenue
    - Completion rates
    - Pending approvals
    - Recent purchases
    - Support requests

- Instructor Dashboard:
    - Assigned courses
    - Draft courses
    - Published courses
    - Enrolled students
    - Course completion rates
    - Quiz performance
    - Pending assignments
    - Student questions
    - Earnings, if marketplace revenue sharing is enabled

- Student Dashboard:
    - Enrolled courses
    - Continue learning
    - Progress
    - Upcoming deadlines
    - Certificates
    - Wishlist
    - Purchase history
    - Notifications

- Finance Dashboard:
    - Revenue
    - Invoices
    - Refunds
    - Taxes
    - Instructor payouts
    - Failed transactions

### 7.11 Ecommerce And Marketplace

Required features:

- Course pricing.
- Cart and checkout.
- One-time purchases.
- Subscriptions/memberships.
- Bundles.
- Coupons.
- Gift courses.
- Refund workflow.
- Instructor commission management.
- Payouts.
- Tax calculation.
- Marketplace search and discovery.
- Featured courses and recommendations.

### 7.12 API Requirements

Required API areas:

- Authentication API using Laravel Sanctum or Passport.
- Tenant API.
- User and role API.
- Course catalog API.
- Course authoring API.
- Enrollment API.
- Learning progress API.
- Quiz and assignment API.
- Payment and invoice API.
- Notification API.
- Reporting API.
- Webhook endpoints.
- Public certificate verification API.

API requirements:

- Versioned endpoints, for example `/api/v1`.
- Token-based authentication.
- Tenant-aware authorization.
- Rate limiting.
- Pagination.
- Filtering and sorting.
- Standard JSON response format.
- Validation error format.
- API documentation using OpenAPI/Swagger.
- Webhook signature verification.
- Idempotency keys for payment and enrollment actions.

### 7.13 Database Requirements

Required improvements:

- Add explicit foreign keys for course relationships.
- Replace string price fields with decimal columns.
- Add indexes for tenant, slug, status, user role, email, course status, enrollment status, and created date queries.
- Add soft deletes for user-facing business records.
- Add audit timestamps and actor IDs where needed.
- Add tenant scoping to all tenant-owned records.
- Normalize course content into sections, lessons, assets, quizzes, and enrollments.
- Store files through Laravel filesystem disks rather than direct public-path movement for production storage.
- Add migration naming consistency.
- Add seeders for roles, permissions, admin user, demo tenant, demo categories, and sample courses.

Core future entities:

- Tenants
- Users
- Roles
- Permissions
- Plans
- Subscriptions
- Courses
- Course versions
- Categories
- Lessons
- Enrollments
- Orders
- Payments
- Invoices
- Quizzes
- Assignments
- Certificates
- Notifications
- Reports
- Audit logs
- Integrations

### 7.14 Security Requirements

Required security features:

- Laravel policies/gates for every protected resource.
- Tenant isolation enforcement at query, policy, middleware, and database levels.
- Password reset flow for all user roles.
- Email verification.
- Optional multi-factor authentication.
- CSRF protection for web routes.
- Rate limiting for login, password reset, checkout, API, and webhook endpoints.
- Secure file upload validation, virus scanning for uploaded files, private storage for protected learning resources.
- Signed URLs for private media.
- Input validation and output escaping.
- Protection against IDOR by checking ownership/tenant scope.
- Audit logs for login, logout, role changes, billing actions, course publishing, certificate generation, and impersonation.
- Encryption for sensitive settings and integration tokens.
- Secure session configuration.
- Content Security Policy.
- Regular dependency scanning.
- Backup and restore strategy.
- Data retention and deletion workflows.
- GDPR/CCPA-ready privacy workflows where applicable.

Known current security gaps:

- Instructor course edit/delete routes fetch courses by ID without confirming the course belongs to the authenticated instructor.
- There is no granular permission system beyond role and guard checks.
- Public uploads are moved directly into `public/` and should be replaced with managed storage disks for production.
- Password reset and email verification workflows are not implemented for admin/instructor/student flows.
- Student authentication is not active.
- API authentication is not implemented.

### 7.15 Scalability And Performance Requirements

Required features:

- Queue-backed email, notifications, media processing, reports, imports, exports, and webhook handling.
- Redis or equivalent cache/session support for production.
- Database indexing and query optimization.
- Pagination on all large lists.
- CDN for static assets and course media.
- Object storage such as S3-compatible storage for media.
- Video streaming provider integration.
- Background transcoding for uploaded videos.
- Horizontal application scaling behind a load balancer.
- Read replicas for analytics-heavy workloads when needed.
- Separate analytics/event pipeline for learning activity at scale.
- Observability with logs, metrics, traces, and uptime checks.
- Feature flags for gradual rollout.

### 7.16 Integrations

Required integrations:

- Payment gateways: Stripe, PayPal, Razorpay, or region-specific providers.
- Email providers: SMTP, Mailgun, Postmark, SES, SendGrid.
- SMS/WhatsApp providers: Twilio or local providers.
- Video hosting/streaming: Vimeo, Mux, Cloudflare Stream, YouTube private/unlisted support where appropriate.
- Cloud storage: AWS S3, DigitalOcean Spaces, Cloudflare R2.
- Calendar integrations: Google Calendar, Outlook.
- Meeting/live class integrations: Zoom, Google Meet, Microsoft Teams.
- Analytics: Google Analytics, Segment, PostHog, or internal event analytics.
- CRM/marketing: HubSpot, Mailchimp, ConvertKit, ActiveCampaign.
- SSO: Google, Microsoft, SAML, OAuth2, OpenID Connect.
- Content standards: SCORM, xAPI/LRS.
- Webhooks and Zapier/Make-style automation.

### 7.17 Deployment And DevOps

Required deployment setup:

- Environment-specific `.env` configuration.
- Production-ready web server configuration.
- CI pipeline for linting, tests, build, migration checks, and deployment.
- Automated database migrations with rollback strategy.
- Queue workers managed by Supervisor/Horizon.
- Scheduler configured for Laravel scheduled commands.
- Asset build pipeline.
- Health check endpoint.
- Error monitoring.
- Centralized logs.
- Backups and restore testing.
- SSL/TLS enforcement.
- CDN and object storage configuration.
- Zero-downtime deployment process.
- Separate staging environment.
- Secrets management.

Suggested environments:

- Local development.
- QA/testing.
- Staging.
- Production.

## 8. Common LMS Problems And How This Project Should Solve Them

### 8.1 Weak Multi-Tenant Isolation

Common problem:

Many LMS platforms are built for a single institution and later patched into multi-tenant products. This creates data leakage risk, difficult reporting, inconsistent branding, and billing complexity.

Project solution:

Build tenancy as a core domain concept. Every tenant-owned record should be scoped by tenant, protected by policies, and included in automated tests. Tenant billing, branding, users, content, storage, notifications, and reports should all be isolated.

### 8.2 Poor Course Authoring Experience

Common problem:

Instructors often struggle with rigid course builders, no draft workflow, difficult media uploads, and weak publishing controls.

Project solution:

Provide a structured curriculum builder with drafts, previews, lesson sections, media library, versioning, approval workflow, and publish scheduling.

### 8.3 Limited Reporting

Common problem:

Existing platforms often show basic counts but fail to explain learning outcomes, revenue performance, student drop-off, or instructor effectiveness.

Project solution:

Capture learning events and convert them into actionable analytics for platform admins, tenant admins, instructors, and students. Add exports, scheduled reports, course funnel analysis, and assessment insights.

### 8.4 Fragmented Payments

Common problem:

Many LMS platforms handle either course purchases or SaaS billing, but not both cleanly.

Project solution:

Separate SaaS tenant subscriptions from student course purchases. Support invoices, taxes, failed payment workflows, coupons, refunds, commissions, and webhook-driven payment state.

### 8.5 Inflexible Roles

Common problem:

Basic role systems cannot represent real organizations with admins, instructors, reviewers, assistants, finance users, and support agents.

Project solution:

Implement role-based and permission-based access control with tenant-scoped custom roles and course-scoped permissions.

### 8.6 Poor Student Engagement

Common problem:

Learners drop off when platforms do not provide reminders, progress feedback, deadlines, discussions, or mobile-friendly learning experiences.

Project solution:

Add progress tracking, reminders, discussions, notes, bookmarks, certificates, dashboard recommendations, and responsive learning pages.

### 8.7 Scaling Problems With Media

Common problem:

Uploading videos directly to the application server creates storage, bandwidth, and performance problems.

Project solution:

Use object storage, signed URLs, CDN delivery, and dedicated video processing/streaming providers for course media.

### 8.8 Weak Compliance And Auditability

Common problem:

Business LMS customers often require audit trails, role change history, data exports, certificate verification, privacy controls, and access logs.

Project solution:

Add audit logs, tenant data export, deletion workflows, public certificate verification, security policies, and compliance-friendly reporting.

## 9. Primary Workflows

### 9.1 Platform Admin Workflow

1. Login as super admin.
2. View platform dashboard.
3. Create and manage subscription plans.
4. Create, approve, suspend, or delete tenants.
5. Monitor subscriptions, failed payments, usage, and system health.
6. Review audit logs.
7. Manage global settings and integrations.
8. Handle support escalation with audited impersonation.

### 9.2 Tenant Onboarding Workflow

1. Tenant owner signs up.
2. Selects plan or starts trial.
3. Adds organization details.
4. Configures branding and domain.
5. Invites admins and instructors.
6. Creates course categories.
7. Publishes first course.
8. Invites or sells to students.

### 9.3 Admin Course Setup Workflow

1. Tenant admin creates categories and sub-categories.
2. Tenant admin creates or invites instructors.
3. Instructor creates course draft.
4. Instructor builds curriculum.
5. Instructor adds media, resources, quizzes, assignments, and certificate rules.
6. Content reviewer approves course.
7. Course is published to the catalog.

### 9.4 Student Purchase And Learning Workflow

1. Student registers or logs in.
2. Student browses/searches courses.
3. Student views course details.
4. Student purchases or enrolls.
5. Student opens learning player.
6. Student completes lessons and assessments.
7. System tracks progress.
8. Student completes course.
9. Certificate is issued.
10. Student reviews the course.

### 9.5 Instructor Teaching Workflow

1. Instructor logs in.
2. Views dashboard.
3. Creates or updates courses.
4. Reviews student enrollments and progress.
5. Responds to discussions.
6. Grades assignments.
7. Reviews course analytics.
8. Improves content based on drop-off and assessment data.

### 9.6 Billing Workflow

1. Tenant chooses a SaaS plan.
2. Payment method is collected securely.
3. Subscription is activated.
4. Webhooks update subscription and invoice status.
5. Failed payments trigger retries and notifications.
6. Tenant can upgrade, downgrade, cancel, or renew.
7. Admin can view invoices, receipts, taxes, and refunds.

## 10. Frontend Requirements

Required public frontend:

- Responsive homepage.
- Course catalog.
- Course detail pages.
- Category and sub-category pages.
- Instructor profile pages.
- Pricing/checkout pages.
- Login/register/password reset pages.
- Tenant-branded portal pages.
- Contact/support pages.
- Certificate verification page.

Required dashboards:

- Platform admin dashboard.
- Tenant admin dashboard.
- Instructor dashboard.
- Student dashboard.
- Finance dashboard.
- Support dashboard.

Required learning UI:

- Course player.
- Lesson navigation.
- Progress indicators.
- Notes and bookmarks.
- Quiz/exam interface.
- Assignment upload interface.
- Discussion panel.
- Certificate page.
- Mobile-friendly layout.

Required UX standards:

- Clear navigation by role.
- Fast search and filtering.
- Accessible forms and controls.
- Consistent validation messages.
- Loading, empty, error, and success states.
- Responsive design for mobile, tablet, and desktop.
- Tenant branding support without breaking usability.

## 11. Backend Requirements

Required backend capabilities:

- Tenant management.
- Authentication for all roles.
- Authorization policies.
- User and role management.
- Course management.
- Course content management.
- Enrollment management.
- Progress tracking.
- Assessment engine.
- Certificate generation.
- Ecommerce checkout.
- SaaS subscriptions.
- Payment webhooks.
- Reporting and analytics.
- Notifications.
- File and media management.
- API layer.
- Audit logging.
- System settings.
- Integrations.
- Background jobs.

Required backend quality standards:

- Service classes for business logic.
- Policies for authorization.
- Form requests for validation.
- Resource classes for API output.
- Events/listeners for side effects.
- Jobs for slow tasks.
- Tests for critical workflows.
- Consistent error handling.
- Idempotent payment and webhook flows.

## 12. Known Current Limitations And Technical Debt

- Student module is not active.
- No tenant model or tenant isolation exists.
- No subscription or payment module exists.
- No enrollment model exists.
- No lesson/curriculum structure exists.
- No quizzes, assignments, gradebook, or certificates exist.
- Course prices are stored as strings instead of decimal values.
- Course table uses integer IDs without declared foreign key constraints.
- Course slug validation does not currently ignore the existing course during update, which can block saving an unchanged slug.
- Instructor course edit and delete actions should enforce ownership, not only authentication.
- Admin and instructor dashboards are present but do not yet surface real metrics.
- Info box/admin content settings are not implemented.
- Contact inquiries are not persisted.
- User routes are commented out.
- Only default tests exist.
- File uploads use direct public directory storage.
- The user migration appears to intend nullable first and last names, but uses `nullable` without `()`, so this should be reviewed.
- No API layer exists.
- No queue-backed notification workflows exist yet.
- No CI/CD, production deployment documentation, backup process, or monitoring setup is present in the repo.

## 13. Development Roadmap

### Phase 1: Stabilize Current LMS Foundation

- Fix migration issues and database constraints.
- Add seeders for admin, instructor, categories, and sample courses.
- Add authorization policies for admin and instructor actions.
- Enforce instructor ownership on course edit/update/delete.
- Fix course slug update validation.
- Replace direct upload handling with Laravel filesystem disks.
- Add feature tests for existing auth and CRUD modules.
- Add real dashboard counts for admin and instructor.
- Complete admin info and contact modules.

### Phase 2: Student And Learning Core

- Implement student registration, login, profile, and dashboard.
- Implement course detail pages.
- Implement enrollments.
- Implement learning player.
- Implement lessons, sections, resources, and progress tracking.
- Implement reviews, wishlist, notes, and bookmarks.
- Implement certificates.

### Phase 3: Course Authoring And Assessments

- Build curriculum builder.
- Add course drafts and publishing workflow.
- Add quizzes and question bank.
- Add assignments and submissions.
- Add gradebook.
- Add instructor analytics.
- Add course approval workflow.

### Phase 4: SaaS Multi-Tenancy

- Add tenant model and tenant scoping.
- Add tenant onboarding.
- Add tenant branding and settings.
- Add tenant domains/subdomains.
- Add tenant-scoped roles and permissions.
- Add tenant usage limits.
- Add super admin tenant management.

### Phase 5: Billing, Payments, And Marketplace

- Add SaaS plans and subscriptions.
- Integrate payment gateway.
- Add invoices, transactions, coupons, refunds, and webhooks.
- Add course purchase checkout.
- Add commission and payout logic if marketplace mode is enabled.
- Add billing dashboard.

### Phase 6: Reporting, Notifications, And Integrations

- Add event/activity tracking.
- Build analytics dashboards.
- Add report exports.
- Add notification templates and preferences.
- Add email/SMS/push integrations.
- Add calendar/live class integrations.
- Add API documentation.

### Phase 7: Production Readiness

- Add CI/CD pipeline.
- Add staging and production deployment scripts/docs.
- Add monitoring and error tracking.
- Add backups and restore testing.
- Add performance optimization.
- Add security hardening.
- Add compliance workflows.
- Run load testing.
- Complete documentation and admin operating procedures.

## 14. Suggested MVP Scope

The fastest credible MVP should include:

- Admin authentication.
- Instructor authentication.
- Student authentication.
- Category/sub-category management.
- Instructor management.
- Course metadata management.
- Course curriculum builder.
- Public course catalog and detail pages.
- Enrollment.
- Learning player.
- Progress tracking.
- Basic quizzes.
- Certificate generation.
- Stripe or equivalent payment integration.
- Tenant model with basic tenant scoping.
- Tenant branding.
- Basic subscription plans.
- Email notifications.
- Admin, instructor, and student dashboards.
- Core reports.
- Feature tests for major workflows.

## 15. Definition Of Production Ready

The platform should be considered production ready only when:

- All user roles have complete authentication and dashboard flows.
- Tenant isolation is implemented and tested.
- Payments and subscription webhooks are reliable and idempotent.
- Course purchase, enrollment, learning, progress, assessment, and certificate workflows are complete.
- Authorization policies protect every protected action.
- Sensitive files are stored securely outside public web roots.
- Critical workflows have automated tests.
- Background jobs, queues, scheduler, and notifications are configured.
- Monitoring, logging, backups, and restore procedures are in place.
- API endpoints are documented and rate-limited.
- Deployment process is repeatable.
- Performance has been tested against expected tenant, user, course, and media volume.
- Legal pages, privacy controls, and data export/deletion workflows are available where required.

## 16. Immediate Next Tasks

Recommended next engineering tasks:

1. Add a real project README that replaces the default Laravel README.
2. Fix current migration and validation issues.
3. Add seeders for admin and instructor accounts.
4. Add policy checks for instructor course ownership.
5. Add student authentication and dashboard.
6. Add course detail page and enrollment model.
7. Normalize course content into sections and lessons.
8. Add test coverage for existing admin/instructor flows.
9. Design the tenant data model before adding payment features.
10. Choose payment gateway and video hosting provider.
