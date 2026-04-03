# 🏢 Multi-Tenant System using Spatie (Domain-Based)

This project demonstrates a **multi-tenant architecture** built with Laravel using **Spatie Multitenancy** package, where each tenant is isolated by its own database and identified via domain.

---

## 🚀 Features

* Domain-based tenant identification
* Automatic database switching per tenant
* Clean separation between landlord and tenant data
* Ability to dynamically add new tenants
* Scalable architecture for SaaS applications

---

## ⚙️ How It Works

* Each tenant has:

  * A unique domain (e.g. `talent1.com`, `talent2.com`)
  * A dedicated database

* When a request is made:

  1. The system detects the tenant via domain
  2. Loads tenant data from landlord database
  3. Switches database connection dynamically
  4. Executes queries on the tenant database

---

## 🧠 Key Concepts Learned

* Understanding **multi-tenancy architecture**
* Using **Spatie Multitenancy**
* Implementing:

  * `InitializeTenancyByDomain`
  * `SwitchTenantDatabaseTask`
* Handling dynamic database connections in Laravel
* Debugging tenant resolution & database switching

---

## ➕ Adding a New Tenant

To add a new tenant:

1. Create a new database
2. Insert tenant record into `tenants` table:

```sql
INSERT INTO tenants (id, domain, database)
VALUES (3, 'tenant3.com', 'tenant3_db');
```

3. Update your `/etc/hosts`:

```bash
127.0.0.1 tenant3.com
```

4. Configure Apache VirtualHost

5. Done ✅ — tenant is ready to use!

---

## 📸 Example Responses

### Tenant 1

![Tenant1](public/Screenshot%20from%202026-04-03%2019-38-08.png)

### Tenant 2

![Tenant2](public/Screenshot%20from%202026-04-03%2019-37-55.png)

---

## 🛠 Tech Stack

* Laravel
* Spatie Multitenancy
* MySQL

---

