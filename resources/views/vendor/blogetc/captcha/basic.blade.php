<div class="form-group ">
    <label id="captcha_label"
           for="captcha">キャプチャ: {{ config("blogetc.captcha.basic_question", "[error - undefined captcha question]" )}} </label>
    <input type='text' required class="form-control" name='captcha' id="captcha" placeholder=""
           value="{{old("captcha")}}">
</div>