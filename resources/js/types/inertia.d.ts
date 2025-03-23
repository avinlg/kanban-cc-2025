import { PageProps as InertiaPageProps } from '@inertiajs/core';

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        $page: InertiaPageProps & {
            props: {
                auth: {
                    user: {
                        id: number;
                        name: string;
                        email: string;
                    } | null;
                };
            };
        };
    }
}