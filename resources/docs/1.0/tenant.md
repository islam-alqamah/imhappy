# Multi-Tenant SaaS Architecture

---

- [Single Database](#section-1)

Multi-tenant architectures are the industry standard for enterprise SaaS applications, it is a good choice for businesses that want to get started with fewer hardware requirements and easier onboarding. It is also ideal for customers who don’t have the internal resources needed to handle the maintenance requirements of single tenant SaaS environments.

<a name="section-1"></a>

### Single Database Multi-tenancy

When using the "single database" version, data from all tenants will be gathered into a single database and separated by columns containing tenantID's.

SaasWeb using this approach and Tenant relationships are handled automatically.

### Model setup
If your models are somehow limited to the current team you will find yourself writing this query over and over again: 
```php 
Model::where('team_id', auth()->user()->currentTeam->id)->get();
```
> {info} This assumes that the model has a field called `team_id`.

```php 
use App\Traits\UsedByTeams;

class Task extends Model
{
    use UsedByTeams;
}
```
### Tenants CRUD Operations
By adding `UsedByTeams` trait on a model. you can now call CRUD operations directly.

```php 
// gets all tasks for the currently active team of the authenticated user
Task::all();
```
### Normal CRUD Operations
SaaSWeb gives you ability to fetch data to perform normal CRUD operations on models with `UsedByTeams` trait.
To do so, you can use `allTeams` scope when fetching records associated with that model.

> {warning} For example this operations can be done on: admin dashboard.

```php 
// gets all tasks from all teams globally
Task::allTeams()->get();
```
