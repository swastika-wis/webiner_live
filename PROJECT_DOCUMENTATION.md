# Project Documentation: Webinar Management System

## 1. Introduction
This project is a comprehensive Webinar and Meeting Management System built using the Laravel framework. It facilitates the organization, hosting, and participation in online meetings (integrated with Zoom), complete with features for polls, Q&A, and user management.

## 2. System Architecture
The system is divided into three primary sections based on user roles:
1.  **Admin/Organizer (WebUser)**: Central control for managing meetings, vendors, and participants.
2.  **Vendor (Host)**: Entity responsible for hosting specific meetings and managing interactive elements like polls.
3.  **Participant**: End-users who attend meetings and interact via polls and Q&A.

## 3. Section Workflows

### 3.1. Admin/Organizer (WebUser) Workflow
The Admin or WebUser is the primary administrator of the system.

*   **Authentication**:
    *   **Login**: Access via the root URL.
    *   **Register**: Admins can register new WebUsers via the `store` method.
*   **Dashboard**:
    *   Upon login, the admin is directed to the **Dashboard** (`/dashboard`), which lists all scheduled meetings.
*   **Meeting Management**:
    *   **Create Meeting**: Admins can schedule new meetings (`/create-meeting`).
        *   This involves setting topics, start times, duration, and assigning a vendor.
        *   The system integrates with Zoom to generate meeting credentials automatically or accepts manual meeting URLs.
    *   **Store Meeting**: Saves meeting details to the database (`/store-meeting`).
    *   **View Meetings**: Lists upcoming or past meetings.
*   **Vendor Management**:
    *   **Manage Vendors**: Admins can view and add new vendors (`/vendors`, `/vendors-store`) who will act as hosts for meetings.
*   **Participant Management**:
    *   **Status Control**: Admins can activate or deactivate participants (`/update-participant-status/{status}/{id}`).
    *   **Password Reset**: Admins can reset participant passwords (`/update-participant-password/{id}`).

### 3.2. Vendor (Host) Workflow
Vendors are the hosts or presenters of the webinars.

*   **Authentication**:
    *   **Login**: Vendors log in using a specific Vendor ID (`/vendor-login/{vendor_id}`).
    *   **Validation**: Credentials are verified against the `vendoruser` guard (`/vendor-validate`).
*   **Dashboard**:
    *   Displays meetings assigned to the specific vendor (`/vendor-dashboard`).
*   **Meeting Execution**:
    *   **Join Meeting**: Vendors have a specialized view to join and host meetings (`/vendor-join-meeting/...`).
*   **Interactive Features**:
    *   **Create Polls**: Vendors can create polls for their meetings (`/create-poll/{meeting_id}`).
        *   Supports text and image-based questions.
    *   **Poll Lists**: View created polls and their status (`/vendor-poll-list`).
    *   **Q&A**: View and manage questions asked by participants (`/vendor-qna-list`).

### 3.3. Participant Workflow
Participants are the attendees of the webinars.

*   **Registration & Login**:
    *   **Register**: Participants register for a specific meeting via a Registration Link (`/register-user/{meeting_id}`).
    *   **Login**: Access via `user-login/{meeting_number}` using their registered phone number.
*   **Dashboard**:
    *   **User Dashboard**: Central hub for the participant (`/user-dashboard`).
*   **Meeting Participation**:
    *   **Join Meeting**: Access the live meeting interface (`/join-meeting/{meeting_id}`).
*   **Interaction**:
    *   **Polls**:
        *   **View Polls**: See available polls for the current meeting (`/poll-list/{meeting_number}`).
        *   **Submit Answers**: Vote on active polls (`/user-poll-submission`).
    *   **Q&A**:
        *   **Ask Question**: Submit questions to the host (`/user-qna-submission`).
        *   **View Q&A**: See their own or public questions (`/qna-list/...`).
    *   **Profile**:
        *   Participants can update their password for security (`/user-upadtepassword`).

## 4. Technical Features

### Zoom Integration
The application uses a `ZoomService` to communicate with the Zoom API.
*   **Meeting Creation**: Automatically creates meetings in Zoom when scheduled in the app.
*   **Meeting Details**: Stores Meeting ID, Password, and Join URLs.

### Database Models
*   **MeetingModel**: Stores meeting metadata (Topic, Time, Duration, Zoom ID).
*   **Participent**: Stores attendee details (Name, Email, Phone, Company).
*   **Vendor**: Stores host details.
*   **PollModel / PollOptionModel**: Manages poll questions and options.
*   **QNAModel**: Manages Questions and Answers.
*   **WebUser**: Stores Admin/Organizer credentials.

### Mailing System
*   **Registration Emails**: Automatically sends confirmation emails to participants upon registration.
*   **Bulk Emails**: Admins can send bulk emails to participants of a specific meeting.

## 5. Middleware & Security
*   **commonAuthGroup**: Protects routes accessible by both Vendors and Admins (e.g., viewing live participants).
*   **webuserGroup**: Protects Admin-only routes.
*   **participateGroup**: Protects Participant specific routes.
*   **vendorGroup**: Protects Vendor specific routes.

---
*Created for Project Documentation Purposes.*
