# Security

---

- [Single Database](#section-1)

Saasify allow the user to update their password, enable / disable two-factor authentication, and logout their other browser sessions.

<a name="section-1"></a>

### Two-Factor Authentication

When a user enables two-factor authentication for their account, they should scan the given QR code using a free authenticator application such as Google Authenticator. In addition, they should store the listed recovery codes in a secure password manager such as 1Password.

If the user loses access to their mobile device, the Jetstream login view will allow them to authenticate using one of their recovery codes instead of the temporary token provided by their mobile device's authenticator application.

### Browser Sessions
This feature utilizes Laravel's built-in AuthenticateSession middleware to safely logout other browser sessions that are authenticated as the current user.

### Tenants CRUD Operations
By adding `UsedByTeams` trait on a model. you can now call CRUD operations directly.

