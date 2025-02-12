export {};

declare global {
    interface Window {
        Alpine: typeof import("alpinejs");
    }
}
