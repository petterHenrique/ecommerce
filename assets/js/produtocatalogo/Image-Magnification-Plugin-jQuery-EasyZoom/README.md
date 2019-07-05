# EasyZoom

> EasyZoom: A concise, easily, lightly (3KB) magnifier plugin of jQuery.



**[中文](./README_ZH.md)**

#### Features

---

* Concise：document is exhaustive and clearly
* Lightly : the javascript file that compressed is just 3KB, and is one-twenty two of the other magnifier plugin 



#### Dependence

---

* jQuery



#### Quick start

---

```shell
// download project
git clone https://github.com/javashop/EasyZoom.git
```



```Html
<!-- other code ... -->
<link rel='stylesheet' href='./easyzoom.min.css'>

<div class='easyzoom gakki'>
  <img src='./gakki.png'>
</div>
<div class='easyzoom ldy'>
  <img src='./ldy.png'>
</div>

<script>
  // Call the plugin
  $('.gakki').easyZoom({
    width: 400,
    position: 'right'
  });
  $('.ldy').easyZoom({
    width: 300,
    position: 'left'
  });
</script>
```



#### Config

---

| Variable   | Description                              | Value-Chosen             | Default |
| ---------- | ---------------------------------------- | ------------------------ | ------- |
| width      | width and height of magnifier container(square for now) | A positive number        | 400     |
| position   | direction of zoom                        | left\|right\|top\|bottom | right   |
| background | background-color of magnifier            | Legal color value of CSS | #FFF    |
| opacity    | opacity of magnifier                     | 0~1（legal CSS value）     | 0.7     |
| distance   | distance between zoom area and magnifier container | A positive number        | 20      |
