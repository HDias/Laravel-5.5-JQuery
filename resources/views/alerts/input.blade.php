{{--
<!-- Exemplo is-invalid -->
<!-- <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="City" required>
<div class="invalid-feedback">
    Please provide a valid city.
</div> -->
--}}
@if ($errors->has($name))
    <div class="invalid-feedback" style="display: block;">
        {{ $errors->first($name) }}
    </div>
@endif

{{--
<!-- Mostra mensagem em verde -->
<!-- Adicionar a classe is-valid no input -->
<!-- <div class="valid-feedback">
    Looks good!
</div> -->

<!-- Exemplo -->
<!-- <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Last name" value="Otto" required>
<div class="valid-feedback">
    Looks good!
</div> -->
--}}