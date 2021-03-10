<?php

    class TestController extends Controller
    {

        use DrawTrennerMixin;

        protected $template = 'home/home.php';

        protected function get($request) {

            ?>

                <link rel='stylesheet' href='<?= Url::find('static', 'style/style.css') ?>'>

                <div id="app">
                    <img :src="src" width="800" height="400"/>

                    <br>
                    <button v-on:click="changeImage(7)">7</button><br>
                    <button v-on:click="changeImage(30)">30</button><br>
                    <button v-on:click="changeImage(60)">60</button><br>
                    <button v-on:click="changeImage(90)">90</button><br>
                </div>



                <script src="https://unpkg.com/vue@next"></script>
                <script src="<?=Url::find('static', 'js/test.js')?>"></script>

            <?php

        }

        protected function post($request) {

        }

    }
