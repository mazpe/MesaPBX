@extends('layouts.master')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@stop

@section('content')

<div ng-app="" ng-controller="personController">
<ul>
    <li ng-repeat="user in users">
        <span> {{user.name}}</span>
    </li>
</ul>
</div>


<script>
function personController($scope) {
        $scope.users = [
            {name:'Jani',country:'Norway'},
            {name:'Hege',country:'Sweden'},
            {name:'Kai',country:'Denmark'}
        ];;
}
</script>
@stop
