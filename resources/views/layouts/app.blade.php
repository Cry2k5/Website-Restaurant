@props(['title' =>''])
<x-base-layout :$title bodyClass="animsition">
<x-layouts.header/>
    {{$slot}}
<x-layouts.footer/>
</x-base-layout>


