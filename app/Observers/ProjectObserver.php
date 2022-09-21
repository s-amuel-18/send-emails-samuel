<?php

namespace App\Observers;

use App\Models\Project;
use Illuminate\Support\Str;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function created(Project $project)
    {

        // * VALIDACION PARA CREAR EL SLUG NAME POSTERIORMENTE
        if ($project->name ?? false) {
            // * ESTA VARIABLE NOS PERMITE AUMENTAR SU VALOR EN CASO DE QUE EL SLUG GENERADO YA ESTÉ EN USO
            $loops = 0;

            do {
                // * SI LA VARIABLE AUXILIAR YA HA SIDO AUMENTADA GENERAREMOS UN SLUG MAS PRODUCIDO, DE FORMA QUE NO SE REPITAN SLUGS
                if ($loops > 0) {

                    // * GENERAMOS EL SLUG NAME MAS ESPECIFICO
                    $slug_name = Str::slug($project->name) . "-" . uniqid();
                } else {

                    // * GENERAMOS EL SLUG NAME
                    $slug_name = Str::slug($project->name);
                }

                // * CANTIDAD DE PROYETOS CON EL SLUG NAME CREADO
                $projects_count = Project::whereSlug($slug_name)->count();

                // * EN CASO DE QUE EXISTA ALGUN PROYECTO CON EL SLUG NAME GENERADO
                if ($projects_count > 0) {
                    // * AUMENTANIS EK VALOR DE LA VARIABLE AUXILIAR
                    $loops += 1;
                }
            } while ($projects_count > 0);

            // * AGREGAMOS EL SLUG AL PROYECTO
            $project->slug = $slug_name;
            $project->save();
        }
    }

    /**
     * Handle the Project "updated" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function updated(Project $project)
    {
        //
    }

    /**
     * Handle the Project "deleted" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the Project "restored" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     *
     * @param  \App\Models\Project  $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
