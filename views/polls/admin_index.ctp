<div class="example index">
    <h2><?php echo $title_for_layout; ?></h2>

    <div class="actions">
        <ul>
            <li><?php echo $html->link(__('New poll', true), array('action'=>'add')); ?></li>
        </ul>
    </div>

    <table cellpadding="0" cellspacing="0" class="ui-corner-all">

        <tbody>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Created</th>
                <th>Expiration</th>
                <th>Actions</th>
            </tr>
            <?php foreach( $polls as $poll ): ?>
                <tr>
                    <?php foreach( array('id', 'question', 'created', 'expiration') as $field ): ?>

                        <td>
                            <?php echo $poll['Poll'][$field]; ?>
                        </td>

                    <?php endforeach; ?>

                    <td>
                        <?php
                            echo $html->link(__('Editar', true),   array('plugin'=>'poll', 'controller'=>'polls', 'action' => 'admin_edit', $poll['Poll']['id']));
                            echo $html->link( __('Delete', true),
                                            array('plugin'=>'poll', 'controller'=>'polls', 'action' => 'admin_delete', $poll['Poll']['id']),
                                            null, __('Are you sure?',true));
                        ?>
                    </td>

                </tr>
            <?php endforeach; ?>
                
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Created</th>
                <th>Expiration</th>
                <th>Actions</th>
            </tr>
        </tbody>
    </table>
</div>
