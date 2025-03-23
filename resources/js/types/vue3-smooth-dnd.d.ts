declare module 'vue3-smooth-dnd' {
    import { DefineComponent } from 'vue';

    export interface DropResult {
        removedIndex: number | null;
        addedIndex: number | null;
        payload: any;
        element: any;
    }

    export const Container: DefineComponent<{
        groupName?: string;
        orientation?: 'vertical' | 'horizontal';
        behaviour?: 'move' | 'copy' | 'drop-zone';
        getChildPayload?: (index: number) => any;
        dragClass?: string;
        dropClass?: string;
        onDrop?: (dropResult: DropResult) => void;
        onDragStart?: () => void;
        onDragEnd?: () => void;
        onDragEnter?: () => void;
        onDragLeave?: () => void;
        onDropReady?: (dropResult: DropResult) => void;
        removeOnDropOut?: boolean;
        lockAxis?: 'x' | 'y';
        dragHandleSelector?: string;
        nonDragAreaSelector?: string;
        useDragHandle?: boolean;
        scrollSpeed?: number;
        autoScrollEnabled?: boolean;
    }>;

    export const Draggable: DefineComponent<{
        key?: string | number;
    }>;
}