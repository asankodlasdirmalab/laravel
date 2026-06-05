Dərs 10 Tapşırıqlar

1. Bu adresə gedin [Link](https://github.dev/asankodlasdirmalab/laravel/tree/main/dersler/ders-10-authorization) və ``ders-10-authorization`` dersini Download edin
2. Gate ilə post update üçün icazə hazırlıyın ancaq postun sahibi postu dəyişdirə bilər (update-post) ``app/Providers/AppServiceProvider/boot))``
3. update-post Icazəsini PostController-də tətbiq edin
4. Gate ilə post silmək icazəsi yaradın, ancaq postun sahibi postu silə bilər və Controller-də tətbiq edin
5. Post Policy yaradın ``php artisan make:policy PostPolicy --model=Post``
6. Policy ``AppServiceProvider``-ə əlavə edin
7. Policy ilə view, create, update, delete icazələri yaradın

   ```
      protected $policies = [
           Post::class => PostPolicy::class,
       ];
   ```
8. Policy icazələrini Controller-ə tətbiq edin ($this->authorize(""))
9. auth()-user()->can() funksiyasından istifadə edərək icazəni yoxluyun
10. Blade-də @can -dən istifadə edərək Silmə və editləmə tətbiq edin
11. Roles və Permissions adlı table-lar yaradın

    ```
    php artisan make:model Role -m
    php artisan make:model Permission -m

    ```
12. Aşağıdakı columnları əlavə edin

    ```

    Schema::create('roles', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique(); 
        $table->string('ekran_adi');
        $table->timestamps();
    });


    Schema::create('permissions', function (Blueprint $table) {
        $table->id();
        $table->string('name')->unique();
        $table->string('ekran_adi'); 
        $table->timestamps();
    });

    Schema::create('role_user', function (Blueprint $table) {
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('role_id')->constrained()->onDelete('cascade');
        $table->primary(['user_id', 'role_id']);
    });

    Schema::create('permission_role', function (Blueprint $table) {
        $table->foreignId('permission_id')->constrained()->onDelete('cascade');
        $table->foreignId('role_id')->constrained()->onDelete('cascade');
        $table->primary(['permission_id', 'role_id']);
    });

    ```
13. Role Modelində belongsToMany() yaradın

    ```
     public function users()
        {
            return $this->belongsToMany(User::class);
        }

        public function permissions()
        {
            return $this->belongsToMany(Permission::class);
        }
    ```
14. Permission Modelində belongsToMany() yaradın

    ```
     public function roles()
        {
            return $this->belongsToMany(Role::class);
        }
    ```
15. User modelinə bunları əlavə edin

    ```

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function hasRole(string|array $role): bool
    {
        if (is_array($role)) {
            return $this->roles()->whereIn('name', $role)->exists();
        }
        return $this->roles()->where('name', $role)->exists();
    }

    public function hasPermission(string $permission): bool
    {
        return $this->roles()
            ->whereHas('permissions', function ($query) use ($permission) {
                $query->where('name', $permission);
            })
            ->exists();
    }

    public function assignRole(string $role): void
    {
        $roleModel = Role::where('name', $role)->firstOrFail();
        $this->roles()->syncWithoutDetaching($roleModel);
    }

    public function removeRole(string $role): void
    {
        $roleModel = Role::where('name', $role)->firstOrFail();
        $this->roles()->detach($roleModel);
    }

    ```
16. Seeder-a əlavə edin

    ```

    public function run()
    {
        // Rolları yarat
        $adminRole = Role::create(['name' => 'admin', 'ekran_adi' => 'Administrator']);
        $modRole = Role::create(['name' => 'moderator', 'ekran_adi' => 'Moderator']);
        $editorRole = Role::create(['name' => 'editor', 'ekran_adi' => 'Redaktor']);
        $userRole = Role::create(['name' => 'user', 'ekran_adi' => 'İstifadəçi']);

        // İcazələri yarat
        $permissions = [
            ['name' => 'post.viewAny', 'ekran_adi' => 'Bütün postlara bax'],
            ['name' => 'post.view', 'ekran_adi' => 'Posta bax'],
            ['name' => 'post.create', 'ekran_adi' => 'Post yarat'],
            ['name' => 'post.edit', 'ekran_adi' => 'Post redaktə et'],
            ['name' => 'post.delete', 'ekran_adi' => 'Post sil'],
        ];

        foreach ($permissions as $perm) {
            Permission::create($perm);
        }

        $adminRole->permissions()->attach(Permission::all());

        $modRole->permissions()->attach(
            Permission::whereIn('name', ['post.viewAny', 'post.delete'])->get()
        );

        $editorRole->permissions()->attach(
            Permission::whereIn('name', ['post.viewAny', 'post.create', 'post.edit', 'post.publish'])->get()
        );

        $userRole->permissions()->attach(
            Permission::whereIn('name', ['post.viewAny', 'post.create'])->get()
        );

        // Test istifadəçilər
        $admin = User::factory()->create(['email' => 'admin@test.com', 'name' => 'Admin User']);
        $admin->assignRole('admin');

        $mod = User::factory()->create(['email' => 'mod@test.com', 'name' => 'Moderator User']);
        $mod->assignRole('moderator');

        $editor = User::factory()->create(['email' => 'editor@test.com', 'name' => 'Editor User']);
        $editor->assignRole('editor');
    }

    ```
17. Role və Permission middleware yaradın

    ```
    php artisan make:middleware RoleMiddleware
    ```
18. Middleware route-lara tətbiq edin
19. Middleware policy və gate tətbiq edin
