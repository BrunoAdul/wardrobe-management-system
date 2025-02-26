namespace App\Policies;

use App\Models\User;
use App\Models\ClothingItem;

class ClothingItemPolicy
{
    /**
     * Allow all users to view any ClothingItems.
     */
    public function viewAny(User $user)
    {
        return true; // Allow all users to view
    }

    /**
     * Allow all users to view a specific ClothingItem.
     */
    public function view(User $user, ClothingItem $clothingItem)
    {
        return true; // Anyone can view an item
    }

    /**
     * Allow all users to create ClothingItems.
     */
    public function create(User $user)
    {
        return true; // Allow all users to create items
    }

    /**
     * Allow users to update their own ClothingItems.
     */
    public function update(User $user, ClothingItem $clothingItem)
    {
        return $user->id === $clothingItem->user_id; // Owner can update
    }

    /**
     * Allow users to delete their own ClothingItems.
     */
    public function delete(User $user, ClothingItem $clothingItem)
    {
        return $user->id === $clothingItem->user_id; // Owner can delete
    }
}
