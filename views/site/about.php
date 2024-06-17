<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\helpers\Url;

$this->registerCssFile(Url::to('@web/css/about.css'), ['depends' => [YiiAsset::class]]);

$this->title = 'Sobre el Creador';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="about">
    <div class="profile section">
        <h2>Carlos Almarcha Ruiz</h2>
        <p><strong>Desarrollador Web</strong></p>
        <p>Apasionado por la tecnología y del deporte. Con experiencia en diversos lenguajes de programación y frameworks.</p>
    </div>

    <div class="experience section">
        <h3>Experiencia Laboral</h3>
        <ul>
            <li>
                <strong>Prácticas en Empresa García Baquero</strong>
                <p>Abril 2024 - Junio 2024</p>
                <p>Desarrollo de una aplicación para PDA a formato Web</p>
            </li>
        </ul>
    </div>

    <div class="education section">
        <h3>Educación</h3>
        <ul>
            <li>
                <strong>Ciclo Superior en Desarrollo de Aplicaciones Web</strong>
                <p>IES Juan Bosco (Álcazar de San Juan)</p>
                <p>2022 - 2024</p>
            </li>
            <li>
                <strong>Grado en Historia</strong>
                <p>UCLM (Ciudad Real)</p>
                <p>2015 - 2020</p>
            </li>
        </ul>
    </div>

    <div class="skills section">
        <h3>Habilidades</h3>
        <ul>
            <li>HTML, CSS, JavaScript</li>
            <li>Java, PHP, Yii2</li>
            <li>MySQL</li>
            <li>GitHub</li>
            <li>Desarrollo Ágil (Scrum)</li>
        </ul>
    </div>

    <div class="projects section">
        <h3>Sobre el proyecto</h3>
        <ul>
            <li>
                <strong>Proyecto Afterlife Forum</strong>
                <p>Una plataforma de foro desarrollada con Yii2, que permite a los usuarios crear publicaciones, compartir opiniones y valorar las mismas.</p>
            </li>
        </ul>
    </div>
    </div>
</div>
