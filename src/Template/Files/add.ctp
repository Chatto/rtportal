    <section class="note-section">
   	<h4 id="note-area">Add a Note</h4>
    <?= $this->Form->create('Note', ['type' => 'file']) ?>
            <p>Add a new note below</p>

            <?= $this->Form->input('user_id', ['type' => 'hidden'], ['value' => $authUser['id']]) ?>
            <?= $this->Form->input('subject', ['placeholder' => 'Subject']) ?>

            <?= $this->Form->input('content', ['placeholder' => 'Write your note content here.', 'type' => 'textarea']) ?>

            <?= $this->Form->input('file', ['type' =>'file']) ?>

    <?= $this->Form->button(__('Add Note')); ?>
    <?= $this->Form->end() ?>
    </section>