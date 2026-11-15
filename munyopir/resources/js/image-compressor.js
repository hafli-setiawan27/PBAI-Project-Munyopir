const compressionThreshold = 700 * 1024;
const targetSize = 1800 * 1024;

const canvasToBlob = (canvas, quality) => new Promise((resolve) => {
    canvas.toBlob(resolve, 'image/jpeg', quality);
});

export const compressReceiptImage = async (file) => {
    if (file.size <= compressionThreshold || typeof createImageBitmap !== 'function') {
        return file;
    }

    const bitmap = await createImageBitmap(file);

    try {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        if (!context) {
            return file;
        }

        let bestCandidate = null;

        for (const maxDimension of [1600, 1200, 900]) {
            const scale = Math.min(1, maxDimension / Math.max(bitmap.width, bitmap.height));
            canvas.width = Math.max(1, Math.round(bitmap.width * scale));
            canvas.height = Math.max(1, Math.round(bitmap.height * scale));
            context.drawImage(bitmap, 0, 0, canvas.width, canvas.height);

            for (const quality of [0.84, 0.76, 0.68, 0.6]) {
                const compressedBlob = await canvasToBlob(canvas, quality);

                if (!compressedBlob || compressedBlob.size >= file.size) {
                    continue;
                }

                bestCandidate = compressedBlob;

                if (compressedBlob.size <= targetSize) {
                    return createCompressedFile(file, compressedBlob);
                }
            }
        }

        return bestCandidate ? createCompressedFile(file, bestCandidate) : file;
    } finally {
        bitmap.close();
    }
};

const createCompressedFile = (file, blob) => {
    const filename = file.name.replace(/\.[^.]+$/, '') || 'nota';

    return new File([blob], `${filename}.jpg`, {
        lastModified: file.lastModified,
        type: 'image/jpeg',
    });
};
