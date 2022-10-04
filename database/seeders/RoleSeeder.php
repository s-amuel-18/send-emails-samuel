<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// modelos de rikes y permisos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // * creamos el rol
        $rol1 = Role::create(["name" => "Administrador"]);
        $rol2 = Role::create(["name" => "Trabajador"]);


        // * creamos los permisos de usuarios
        Permission::create(["name" => "user.index", "description" => "Ver Usuarios"])->syncRoles([$rol1]); /* Lo mas recomendable es nombrar el nombre del permiso con el name  de la ruta */
        Permission::create(["name" => "user.create", "description" => "Crear Usuarios"])->syncRoles([$rol1]); /* Lo mas recomendable es nombrar el nombre del permiso con el name  de la ruta */
        Permission::create(["name" => "user.edit", "description" => "Editar Usuarios"])->syncRoles([$rol1]); /* Lo mas recomendable es nombrar el nombre del permiso con el name  de la ruta */
        Permission::create(["name" => "user.destroy", "description" => "Eliminar Usuarios"])->syncRoles([$rol1]); /* Lo mas recomendable es nombrar el nombre del permiso con el name  de la ruta */

        // * permisos de registro de emailsz
        Permission::create(["name" => "contact_email.estadisticas", "description" => "Ver Estadisticas De Registro De emails"])->syncRoles([$rol1]);
        Permission::create(["name" => "contact_email.index", "description" => "Ver Registro De emails"])->syncRoles([$rol1, $rol2]);
        Permission::create(["name" => "contact_email.create", "description" => "Crear Registro De emails"])->syncRoles([$rol1, $rol2]);
        Permission::create(["name" => "contact_email.edit", "description" => "Editar Registro De emails"])->syncRoles([$rol1]);
        Permission::create(["name" => "contact_email.destroy", "description" => "Eliminar Registro De emails"])->syncRoles([$rol1]);

        // * permisos para cuerpos de email
        Permission::create(["name" => "bodyEmail.index", "description" => "Ver Cuerpo de Email"])->syncRoles([$rol1]);
        Permission::create(["name" => "bodyEmail.create", "description" => "Crear Cuerpo de Email"])->syncRoles([$rol1]);
        Permission::create(["name" => "bodyEmail.edit", "description" => "Editar Cuerpo de Email"])->syncRoles([$rol1]);
        Permission::create(["name" => "bodyEmail.destroy", "description" => "Eliminar Cuerpo de Email"])->syncRoles([$rol1]);

        // * permisos para roles
        Permission::create(["name" => "role.index", "description" => "Ver Rol"])->syncRoles([$rol1]);
        Permission::create(["name" => "role.create", "description" => "Crear Rol"])->syncRoles([$rol1]);
        Permission::create(["name" => "role.edit", "description" => "Editar Rol"])->syncRoles([$rol1]);
        Permission::create(["name" => "role.destroy", "description" => "Eliminar Rol"])->syncRoles([$rol1]);

        // * permisos para envio de emails
        Permission::create(["name" => "envio_email.index", "description" => "Enviar Emails"])->syncRoles([$rol1]);


        // * permisos para envio de emails
        Permission::create(["name" => "managment.index", "description" => "Administrar Ingresos"])->syncRoles([$rol1]);

        // * perimisos para manipular proyectos
        Permission::create(["name" => "project.index", "description" => "Ver proyectos"])->syncRoles([$rol1]);
        Permission::create(["name" => "project.create", "description" => "Crear proyectos"])->syncRoles([$rol1]);
        Permission::create(["name" => "project.edit", "description" => "Editar proyectos"])->syncRoles([$rol1]);
        Permission::create(["name" => "project.published", "description" => "Publicar proyectos"])->syncRoles([$rol1]);
        Permission::create(["name" => "project.destroy", "description" => "Eliminar proyectos"])->syncRoles([$rol1]);
    }
}
