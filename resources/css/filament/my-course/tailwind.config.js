import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/MyCourse/**/*.php',
        './resources/views/filament/my-course/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
