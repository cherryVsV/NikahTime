<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
<input type="text"
       id="address"
       class="form-control"
       name="{{ $row->field }}"
       data-name="{{ $row->display_name }}"
       placeholder="{{ isset($options->placeholder)? old($row->field, $options->placeholder): $row->display_name }}"
       value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@else{{old($row->field)}}@endif">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.6.0/dist/css/suggestions.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.6.0/dist/js/jquery.suggestions.min.js"></script>

<script>
    $("#address").suggestions({
        token: "$aed78f6529ea020c8af3cea5014cdfadc585fa37",
        type: "ADDRESS",
        onSelect: function(suggestion) {
           // console.log(suggestion);
        }
    });
</script>
</body>
</html>
