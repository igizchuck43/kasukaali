export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './storage/framework/views/*.php',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
            colors: {
                primary: '#FF4F5E',
                primaryDark: '#E63B4A',
                secondary: '#111827',
                accent: '#FBBF24',
                background: '#FFFFFF',
                surface: '#F9FAFB',
                surfaceDark: '#1F2937',
                borderSoft: '#E5E7EB',
                muted: '#6B7280',
                lightText: '#F9FAFB',
                success: '#22C55E',
                danger: '#EF4444',
            },
            boxShadow: {
                soft: '0 16px 45px rgba(17, 24, 39, .10)',
                glow: '0 0 0 4px rgba(255, 79, 94, .13), 0 18px 36px rgba(255, 79, 94, .25)',
            },
            animation: {
                float: 'float 5s ease-in-out infinite',
                'fade-up': 'fade-up .55s ease-out both',
                'soft-bounce': 'soft-bounce 1.8s ease-in-out infinite',
                counter: 'counter-pop .45s ease-out both',
            },
            keyframes: {
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-12px)' },
                },
                'fade-up': {
                    from: { opacity: '0', transform: 'translateY(18px)' },
                    to: { opacity: '1', transform: 'translateY(0)' },
                },
                'soft-bounce': {
                    '0%, 100%': { transform: 'scale(1)' },
                    '50%': { transform: 'scale(1.04)' },
                },
                'counter-pop': {
                    from: { transform: 'scale(.96)', opacity: '.65' },
                    to: { transform: 'scale(1)', opacity: '1' },
                },
            },
        },
    },
};
