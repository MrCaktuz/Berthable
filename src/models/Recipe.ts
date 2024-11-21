import mongoose, { Schema, models } from "mongoose";

const recipeSchema = new Schema(
  {
    _id: String,
    title: String,
    description: String,
  },
  {
    timestamps: true,
  },
);

const Recipe = models.Recipe || mongoose.model("Recipe", recipeSchema);

export default Recipe;
