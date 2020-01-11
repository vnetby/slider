<?php





function code_editor($sets = [])
{
  $ids = [];
  $modes = ['html' => 'htmlmixed', 'less' => 'text/x-less', 'js' => 'javascript'];
  $labels = ['html' => 'HTML', 'less' => 'LESS', 'js' => 'JS'];
?>
  <div class="code-editor has-tabs">
    <div class="code-controls">
      <?php
      $count = 0;
      foreach ($sets as $key => &$item) {
        $id = get_from_array($item, 'id');
        $ids[$key] = $id ? $id : random_str(5);
        $label = get_from_array($item, 'label');
        $label = $label ? $label : get_from_array($labels, $key);
      ?>
        <a href="#<?= $ids[$key]; ?>" class="tab-link<?= $count === 0 ? ' active' : ''; ?>"><?= $label; ?></a>
      <?php
        $count++;
      }
      ?>
    </div>
    <div class="code-tabs">
      <?php
      foreach ($sets as $key => &$item) {
        $content = get_from_array($item, 'content');
        $mode = get_from_array($modes, $key);
        $textareaClass = get_from_array($item, 'textareaClass');
      ?>
        <div id="<?= $ids[$key]; ?>" class="tab">
          <textarea class="highlight-code<?= $textareaClass ? ' ' . $textareaClass : ''; ?>" data-mode="<?= $mode; ?>"><?= $content; ?></textarea>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
<?php
}
