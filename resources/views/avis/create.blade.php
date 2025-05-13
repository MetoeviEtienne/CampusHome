<form action="{{ route('avis.store', $reservation->id) }}" method="POST">
    @csrf
    <div>
        <label for="note">Note (1-5)</label>
        <input type="number" name="note" min="1" max="5" required>
    </div>

    <div>
        <label for="commentaire">Commentaire</label>
        <textarea name="commentaire" rows="4" required></textarea>
    </div>

    <button type="submit">Soumettre l'avis</button>
</form>
