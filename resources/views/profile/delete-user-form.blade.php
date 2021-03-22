<x-jet-action-section>
    <x-slot name="title">
    <span style="color:white;">
                {{ __('public.profile_deleteAcc') }}
                </span>
    </x-slot>

    <x-slot name="description">
    <span style="color:white;">
    {{ __('public.profile_perm') }}
                </span>
    </x-slot>

    <x-slot name="content" >
        <div class="max-w-xl text-sm text-gray-600">
            {{ __('public.profile_once') }}
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="confirmUserDeletion" wire:loading.attr="disabled" >
                <span style="color:white;">
                {{ __('public.profile_deleteAcc') }}
                </span>
            </x-jet-danger-button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingUserDeletion">
            <x-slot name="title">
            {{ __('public.profile_deleteAcc') }}
            </x-slot>

            <x-slot name="content">
                {{ __('public.profile_sure') }}

                <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}"
                                x-ref="password"
                                wire:model.defer="password"
                                wire:keydown.enter="deleteUser" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('public.profile_cancel') }}
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteUser" wire:loading.attr="disabled">
                {{ __('public.profile_deleteAcc') }}
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
