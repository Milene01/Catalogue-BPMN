@extends('layouts.app')

@section('content')
<div class="container">

    <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Welcome!</h3>
    </div>
    <div class="panel-body">
        <h3> BPMN Extension Catalog </h3>
        <h4> Last update: April 2025 </h4> 
        <p style="text-align: justify;">
        Business Process Model and Notation (BPMN) is a diagrammatic modeling language widely used to represent and manage business processes. Through a standardized set of symbols, BPMN makes it easier to visualize and understand processes. However, despite its popularity and standardization, BPMN can present limitations when applied in specific contexts.
        </p>
        <p style="text-align: justify;">
        To overcome these limitations, modeling language extensions are used - a mechanism that allows the capabilities of a language to be expanded without compromising its original basis. These extensions consist of adding new constructs or adapting existing ones, and are particularly useful for incorporating specific aspects of certain domains or for introducing improvements that are not included in the standard definition. This avoids the need to create a new language or modify BPMN directly, while maintaining compatibility with established tools and practices. In this context, BPMN has often been extended to meet the demands of areas such as Health, Logistics, the Internet of Things (IoT), etc.
        </p>
        <p style="text-align: justify;">
        With this in mind, the BPMN Extension Repository was created, an initiative that aims to facilitate the identification and reuse of previously proposed extensions. This repository - structured as an online catalog - was initially filled with information from a systematic review of the literature on BPMN extensions, and continues to be updated with suggestions for new articles.
        </p>
        <p style="text-align: justify;">
        In the catalog, it is possible to list proposed extensions, view the associated constructs, search by author or title, and filter the constructs by application area, among other filters. In addition, users can suggest new articles for inclusion in the repository, contributing to its continuous expansion.
        </p>
        <h4>Team</h4>
        <ul>
        <li>Milene Cavalcante - Universidade Federal do Ceará (Brazil)</li>
        <li>Enyo Gonçalves - Universidade Federal do Ceará (Brazil)</li>
        <li>Tiago Heineck - Instituto Federal Catarinense (Brazil)</li>
        <li>João Araújo - Universidade Nova de Lisboa (Portugal)</li>
        </ul>
    </div>
    </div>


</div>
@endsection
