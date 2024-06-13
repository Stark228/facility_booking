<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-custom']) }}>
    {{ $slot }}
</button>
<style>
    .custom-button{
        background-color:#3498db;
        color:white;
    }
</style>

