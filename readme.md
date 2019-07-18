
$role = Role::create(['name' => 'Founder']);

Permission::create(['name' => 'manage_contents']);
$role->givePermissionTo('manage_contents');

$user->assignRole('Founder');
$user->assignRole('writer', 'admin');

$user->hasRole('Founder');
$user->hasAnyRole(Role::all());
$user->hasAllRole(Role::all());

$user->can('manage_contents');
$role->hasPermissionTo('manage_content');

$user->givePermissionTo('manage_contents');
$user->getDirectPermissions();

