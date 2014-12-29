<div class="container">
              <header>
                <h2>Rising Tide Developer Registration</h2>
              </header>
    <div class="form">
    <?= $this->Form->create('User', ['type' => 'file']) ?>
            <p>You have been invited to register for the Rising Tide Portal, please fill out the form below and click "Complete Registration" to continue!</p>
            <div class="user-data">
            <table>
            <tr >
                <td style="padding:10px;">
                    Display Name:
                </td>
                <td style="padding:10px;color:#AAA;">
                   <?= $user['display_name']; ?>
                </td>
            </tr>
            <tr >
                <td style="padding:10px;">
                    Department:
                </td>
                <td style="padding:10px;color:#AAA;">
                   <?= $user['department']; ?>
                </td>
            </tr>
            <tr >
                <td style="padding:10px;">
                    Start Date:
                </td>
                <td style="padding:10px;color:#AAA;">
                    <?= ucfirst($this->Time->timeAgoinWords($user['join_date']));?>
                </td>
            </tr>
            <tr >
                <td style="padding:10px;">
                    Email:
                </td>
                <td style="padding:10px;color:#AAA;">
                    <?= $user['email'];?>
                </td>
            </tr>
        </table>
        </div>
            <?= $this->Form->input('username', ['placeholder' => 'Please input a username']) ?>

            <?= $this->Form->input('password', ['type' => 'password', 'placeholder' => 'Please input a Password']) ?>

            <?= $this->Form->input('timezone', ['options' => $timezoneTable]); ?>
    <button type="submit" class="btn btn-success btn-sm">Complete Registration</button>
    <?= $this->Form->end() ?>
    </div>
</div>