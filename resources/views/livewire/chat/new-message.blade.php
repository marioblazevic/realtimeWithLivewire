<div x-data="formScope()">
    <form wire:submit.prevent="send" action="">
        <div class="form-group">
            <textarea wire:model="body" rows="3" x-on:keydown.enter="submit" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-secondary btn-block" x-ref="submit">Send</button>
    </form>
</div>

<script>

    function formScope(){
        return {
            submit(e) {
                if (e.shiftKey) return
                this.$refs.submit.click()
            }
        }
    }

</script>