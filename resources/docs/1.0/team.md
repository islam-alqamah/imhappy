# Teams

---
- [Manage team](#section-1)
- [Manage team](#section-2)

Saasify includes support for allowing your users to create and join teams,  By default, every registered user will belong to a "Personal" team. For example, if a user named "John Doe" creates a new account, they will be assigned to a team named John's Team. After registration, the user may rename this team or create additional teams.

### User Teams methods
`HasTeams` trait is automatically applied to your application's `App\Models\User` model. This trait provides a variety of helpful methods that allow you to inspect a user's teams:
```php 
// Access a user's currently selected team...
$user->currentTeam : Laravel\Jetstream\Team

// Access all of the team's (including owned teams) that a user belongs to...
$user->allTeams() : Illuminate\Support\Collection

// Access all of a user's owned teams...
$user->ownedTeams : Illuminate\Database\Eloquent\Collection

// Access all of the teams that a user belongs to but does not own...
$user->teams : Illuminate\Database\Eloquent\Collection

// Access a user's "personal" team...
$user->personalTeam() : Laravel\Jetstream\Team

// Determine if a user owns a given team...
$user->ownsTeam($team) : bool

// Determine if a user belongs to a given team...
$user->belongsToTeam($team) : bool

// Get the role that the user is assigned on the team...
$user->teamRole($team) : \Laravel\Jetstream\Role

// Determine if the user has the given role on the given team...
$user->hasTeamRole($team, 'admin') : bool

// Access an array of all permissions a user has for a given team...
$user->teamPermissions($team) : array

// Determine if a user has a given team permission...
$user->hasTeamPermission($team, 'server:create') : bool
```
### Current Team
This is the team that the user is actively viewing resources for. 
You may access the user's current team using the Eloquent relationship. This team may be used to scope your other Eloquent queries by the team:
```php 
$user->currentTeam
```
### The Team Object
```php 
// Access the team's owner...
$team->owner : \App\Models\User

// Get all of the team's users, including the owner...
$team->allUsers() : Illuminate\Database\Eloquent\Collection

// Get all of the team's users, excluding the owner...
$team->users : Illuminate\Database\Eloquent\Collection

// Determine if the given user is a team member...
$team->hasUser($user) : bool

// Determine if the team has a member with the given email address...
$team->hasUserWithEmail($emailAddress) : bool

// Determine if the given user is a team member with the given permission...
$team->userHasPermission($user, $permission) : bool
```
### Roles / Permissions
Each team member added to a team may be assigned a given role, and each role is assigned a set of permissions. Role permissions are defined in your application.

```php 
Jetstream::defaultApiTokenPermissions(['read']);

Jetstream::role('admin', 'Administrator', [
    'create',
    'read',
    'update',
    'delete',
])->description('Administrator users can perform any action.');

Jetstream::role('editor', 'Editor', [
    'read',
    'create',
    'update',
])->description('Editor users have the ability to read, create, and update.');
```
### Authorization
A user's team permissions may be inspected using the hasTeamPermission method available via the Laravel\Jetstream\HasTeams trait.

```php 
if ($request->user()->hasTeamPermission($team, 'read')) {
    // The user's role includes the "read" permission...
}
```
### Combining Team Permissions With API Permissions
When building application that provides both API support and team support, you should verify an incoming request's team permissions and API token permissions within your application's authorization policies. This is important because an API token may have the theoretical ability to perform an action while a user does not actually have that action granted to them via their team permissions:
```php 
/**
 * Determine whether the user can view a flight.
 *
 * @param  \App\Models\User  $user
 * @param  \App\Models\Flight  $flight
 * @return bool
 */
public function view(User $user, Flight $flight)
{
    return $user->belongsToTeam($flight->team) &&
           $user->hasTeamPermission($flight->team, 'flight:view') &&
           $user->tokenCan('flight:view');
}
```
Please consult the official <a href="https://jetstream.laravel.com/1.x/introduction.html" target="_blank"> jetstream doc</a>