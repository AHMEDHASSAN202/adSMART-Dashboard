import { InertiaLink } from '@inertiajs/inertia-react'

const ResendVerificationNotificationLink = () => {
    return (
        <InertiaLink as="button" className='as-a' href={route('auth.dashboard.verification.notification')} method="post">{translations['resend_verification_notification']}</InertiaLink>
    );
}

export default ResendVerificationNotificationLink;
