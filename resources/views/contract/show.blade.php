@extends('layouts.base')

@section('title')
Contrat
@endsection

@section('content')

<div class="px-5 py-3" id="contrat">
<h1>Contrat de Partenariat Commercial</h1>

<p>Ce contrat est fait ce jour <span class="strong">{{$dateajd}}</span>, en <span class="strong">{{$nbpartner}}</span> copies originales, entre</p>
<ol>
    @for ($i = 1; $i <= $nbpartner; $i++)
        <li><span class="strong">{{$contract->partners[$i-1]->partner_name}} {{$contract->partners[$i-1]->partner_firstname}}</span></li>
    @endfor

</ol>

<h2>1. NOM DU PARTENARIAT ET ACTIVITÉ</h2>

<p>1.1 Nature des activités: Les Partenaires cités ci-dessus donnent leur accord d'être considérés comme des partenaires commerciaux pour les fins suivantes :</p>
<p><span class="strong">{{$contract->contract_nature}}</span></p>

<p>1.2 Nom: Les Partenaires cités ci-dessus donnent leur accord pour que le partenariat commercial soit exercé sous le nom :</p>
<p><span class="strong">{{$contract->contract_name}}</span></p>

<p>1.3 Adresse officielle: Les Partenaires cités ci-dessus donnent leur accord pour que le siège du partenariat commercial soit :</p>
<p><span class="strong">{{$contract->contract_adress}}</span></p>

<h2>2. TERMES</h2>

<p>2.1 Le partenariat commence le <span class="strong">{{$dateDebutContrat}}</span> et continue jusqu'à la fin de cet accord.</p>

<h2>3. CONTRIBUTION AU PARTENARIAT</h2>

<p>La contribution de chaque partenaire au capital est listée ci-dessous :</p>

<ol>
@for ($i = 1; $i <= $nbpartner; $i++)
    <li><span class="strong">{{$contract->partners[$i-1]->partner_contribution}}</span></li><br>
@endfor
</ol>

<h2>4. RÉPARTITION DES BÉNÉFICES ET DES PERTES</h2>

<p>4.1 Les Partenaires se partageront les profits et les pertes du partenariat commercial de la manière suivante :</p>
<p><span class="strong">{{$contract->contract_repartition}}</span></p>

<h2>5. PARTENAIRES ADDITIONNELS</h2>

<p>5.1 Aucune personne ne peut être ajoutée en tant que partenaire et aucune autre activité ne peut être menée par le partenariat sans le consentement écrit de tous les partenaires.</p>

<h2>6. MODALITÉS BANCAIRES ET TERMES FINANCIERS</h2>

<p>6.1 Les Partenaires doivent avoir un compte bancaire au nom du partenariat sur lequel les chèques doivent être signés par au moins <span class="strong">{{$contract->contract_min_sign}}</span> des Partenaires.</p>


<p>6.2 Les Partenaires doivent tenir une comptabilité complète du partenariat et la rendre disponible à tous les Partenaires à tout moment.</p>

<h2>7. GESTION DES ACTIVITÉS DE PARTENARIAT</h2>

<p>7.1 Chaque partenaire peut prendre part dans la gestion du partenariat.</p>

<p>7.2 Tout désaccord qui intervient dans l'exploitation du partenariat, sera réglé par les partenaires détenant la majorité des parts du partenariat.</p>

<h2>8. DÉPART D'UN PARTENAIRE COMMERCIAL</h2>

<p>8.1 Si un partenaire se retire du partenariat commercial pour une raison quelconque, y compris le décès, les autres partenaires peuvent continuer à exploiter le partenariat sous le même nom.</p>

<p>8.2 Le partenaire qui se retire est tenu de donner un préavis écrit d'au moins soixante (60) jours de son intention de se retirer et est tenu de vendre ses parts du partenariat commercial.</p>

<p>8.3 Aucun partenaire ne doit céder ses actions dans le partenariat commercial à une autre partie sans le consentement écrit des autres partenaires.</p>

<p>8.4 Le ou les partenaires restants paieront au partenaire qui se retire, ou au représentant légal du partenaire décédé ou handicapé, la valeur de ses parts dans le partenariat. Cela inclut :</p>
<ul>
    <li>(a) La somme de son capital</li>
    <li>(b) Des emprunts impayés qui lui sont dus</li>
    <li>(c) Sa quote-part des bénéfices nets cumulés non distribués dans son compte</li>
    <li>(d) Son intérêt dans toute plus-value préalablement convenue de la valeur du partenariat par rapport à sa valeur comptable.</li>
</ul>

<p>Aucune valeur de bonne volonté ne doit être incluse dans la détermination de la valeur des parts du partenaire.</p>


<h2>9. CLAUSE DE NON CONCURRENCE</h2>

<p>9.1 Un partenaire qui se retire du partenariat ne doit pas s'engager directement ou indirectement dans une entreprise qui serait en concurrence avec la nature des activités actuelles ou futures du partenariat pendant <span class="strong">{{$contract->contract_clause_duration}}</span>.</p>

<h2>10. MODIFICATION DE L’ACCORD DE PARTENARIAT</h2>

<p>10.1 Ce contrat de partenariat commercial ne peut être modifié sans le consentement écrit de tous les partenaires.</p>

<h2>11. DIVERS</h2>

<p>11.1 Si une disposition ou une partie d'une disposition de la présente convention de partenariat commercial est non applicable pour une quelconque raison, elle sera dissociée sans affecter la validité du reste de la convention.</p>

<p>11.2 Cet accord de partenariat commercial lie les partenaires commerciaux et pourra servir à leurs héritiers, exécuteurs testamentaires, administrateurs, représentants personnels, successeurs et ayants droit respectifs.</p>


<h2>12. JURIDICTION</h2>

<p>Le présent contrat de partenariat commercial est régi par les lois de l’État de <span class="strong">{{$contract->contract_state}}</span>.</p>

<p>Solennellement affirmé à <span class="strong">{{$contract->contract_location}}</span>, daté de ce jour : <span class="strong">{{$dateajd}}</span></p>

<p>Signé, validé et livré en présence de :</p>

<ul>
    @for ($i = 1; $i <= $nbpartner; $i++)
        <div class='signature'></div><br><div>{{$contract->partners[$i-1]->partner_name}} {{$contract->partners[$i-1]->partner_firstname}}</div>
        <br>
    @endfor
</ul>

<p>Par moi : <span class="strong">{{$contract->contract_avocate_name}}</span></p>
</div>
@endsection
